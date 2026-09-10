#!/usr/bin/env python3
"""Render the four portfolio slides from infographic.html through Chrome CDP."""

from __future__ import annotations

import base64
import json
import time
import urllib.parse
import urllib.request
from pathlib import Path

import websocket


CDP_HTTP = "http://127.0.0.1:9223"
PACKAGE_DIR = Path(__file__).resolve().parent
OUTPUT_DIR = PACKAGE_DIR / "final"


class Cdp:
    def __init__(self) -> None:
        with urllib.request.urlopen(f"{CDP_HTTP}/json", timeout=10) as response:
            pages = json.load(response)
        page = next(item for item in pages if item["type"] == "page")
        self.ws = websocket.create_connection(page["webSocketDebuggerUrl"], timeout=20)
        self.message_id = 0

    def call(self, method: str, params: dict | None = None) -> dict:
        self.message_id += 1
        current_id = self.message_id
        self.ws.send(json.dumps({"id": current_id, "method": method, "params": params or {}}))
        while True:
            message = json.loads(self.ws.recv())
            if message.get("id") == current_id:
                if "error" in message:
                    raise RuntimeError(f"{method}: {message['error']}")
                return message.get("result", {})


def main() -> None:
    OUTPUT_DIR.mkdir(parents=True, exist_ok=True)
    cdp = Cdp()
    cdp.call("Page.enable")
    cdp.call(
        "Emulation.setDeviceMetricsOverride",
        {"width": 1600, "height": 1200, "deviceScaleFactor": 1, "mobile": False},
    )
    url = urllib.parse.urljoin("file:", urllib.request.pathname2url(str(PACKAGE_DIR / "infographic.html")))
    cdp.call("Page.navigate", {"url": url})
    for _ in range(100):
        ready = cdp.call("Runtime.evaluate", {"expression": "document.readyState", "returnByValue": True})
        if ready.get("result", {}).get("value") == "complete":
            break
        time.sleep(0.1)
    time.sleep(1)

    slides = (
        ("slide-cover", "00-cover.png"),
        ("slide-start", "01-start.png"),
        ("slide-work", "02-work.png"),
        ("slide-result", "03-result.png"),
    )
    for element_id, filename in slides:
        expression = f"""
            (() => {{
                const element = document.getElementById({json.dumps(element_id)});
                const rect = element.getBoundingClientRect();
                return {{x: rect.left + scrollX, y: rect.top + scrollY, width: rect.width, height: rect.height}};
            }})()
        """
        rect = cdp.call("Runtime.evaluate", {"expression": expression, "returnByValue": True})["result"]["value"]
        result = cdp.call(
            "Page.captureScreenshot",
            {
                "format": "png",
                "fromSurface": True,
                "captureBeyondViewport": True,
                "clip": {**rect, "scale": 1},
            },
        )
        (OUTPUT_DIR / filename).write_bytes(base64.b64decode(result["data"]))


if __name__ == "__main__":
    main()
