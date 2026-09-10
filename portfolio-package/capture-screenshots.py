#!/usr/bin/env python3
"""Capture deterministic public and WordPress screenshots through Chrome CDP."""

from __future__ import annotations

import base64
import json
import os
import time
import urllib.request
from pathlib import Path

import websocket


CDP_HTTP = "http://127.0.0.1:9223"
SITE_URL = "https://chitayka39.ru/"
OUTPUT_DIR = Path(__file__).resolve().parent / "screenshots"


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

    def navigate(self, url: str) -> None:
        self.call("Page.navigate", {"url": url})
        for _ in range(120):
            result = self.call(
                "Runtime.evaluate",
                {"expression": "document.readyState", "returnByValue": True},
            )
            if result.get("result", {}).get("value") == "complete":
                break
            time.sleep(0.1)
        time.sleep(1.0)

    def viewport(self, width: int, height: int, mobile: bool = False) -> None:
        self.call(
            "Emulation.setDeviceMetricsOverride",
            {
                "width": width,
                "height": height,
                "deviceScaleFactor": 1,
                "mobile": mobile,
                "screenWidth": width,
                "screenHeight": height,
            },
        )

    def prepare_public_page(self, selector: str | None = None) -> None:
        expression = """
            (() => {
                const style = document.createElement('style');
                style.textContent = `
                    *, *::before, *::after {
                        animation: none !important;
                        transition: none !important;
                        scroll-behavior: auto !important;
                    }
                    [data-reveal], .reveal, .is-reveal {
                        opacity: 1 !important;
                        transform: none !important;
                    }
                `;
                document.head.appendChild(style);
                const selector = %s;
                const target = selector ? document.querySelector(selector) : null;
                window.scrollTo(0, target ? Math.max(0, target.offsetTop - 24) : 0);
                return {scrollY: window.scrollY, height: document.documentElement.scrollHeight};
            })()
        """ % json.dumps(selector)
        self.call("Runtime.evaluate", {"expression": expression, "returnByValue": True})
        time.sleep(0.5)

    def screenshot(self, filename: str, full_page: bool = False) -> None:
        params: dict = {"format": "png", "fromSurface": True}
        if full_page:
            metrics = self.call("Page.getLayoutMetrics")
            size = metrics["cssContentSize"]
            params.update(
                {
                    "captureBeyondViewport": True,
                    "clip": {
                        "x": 0,
                        "y": 0,
                        "width": size["width"],
                        "height": size["height"],
                        "scale": 1,
                    },
                }
            )
        result = self.call("Page.captureScreenshot", params)
        (OUTPUT_DIR / filename).write_bytes(base64.b64decode(result["data"]))


def read_env(path: Path) -> dict[str, str]:
    values: dict[str, str] = {}
    for raw_line in path.read_text(encoding="utf-8").splitlines():
        line = raw_line.strip()
        if not line or line.startswith("#") or "=" not in line:
            continue
        key, value = line.split("=", 1)
        values[key] = value.strip().strip('"').strip("'")
    return values


def main() -> None:
    OUTPUT_DIR.mkdir(parents=True, exist_ok=True)
    cdp = Cdp()
    cdp.call("Page.enable")
    cdp.call("Runtime.enable")

    cdp.viewport(1440, 1000)
    cdp.navigate(SITE_URL)
    cdp.prepare_public_page()
    cdp.screenshot("01-hero-desktop.png")

    for filename, selector in (
        ("02-directions-desktop.png", "#directions"),
        ("03-first-visit-desktop.png", "#first-visit"),
        ("05-prices-desktop.png", "#prices"),
    ):
        cdp.prepare_public_page(selector)
        cdp.screenshot(filename)

    cdp.viewport(390, 844, mobile=True)
    cdp.navigate(SITE_URL)
    cdp.prepare_public_page()
    cdp.screenshot("06-mobile-hero.png")

    access_file_value = os.environ.get("CHITAYKA_WP_ACCESS_FILE")
    access_file = Path(access_file_value) if access_file_value else None
    if access_file and access_file.exists():
        credentials = read_env(access_file)
        admin_user = credentials.get("WP_ADMIN_USER")
        admin_password = credentials.get("WP_ADMIN_PASSWORD")
        if admin_user and admin_password:
            cdp.viewport(1440, 1000)
            cdp.navigate(f"{SITE_URL}wp-login.php")
            login_expression = """
                (() => {
                    document.getElementById('user_login').value = %s;
                    document.getElementById('user_pass').value = %s;
                    document.getElementById('loginform').submit();
                    return true;
                })()
            """ % (json.dumps(admin_user), json.dumps(admin_password))
            cdp.call("Runtime.evaluate", {"expression": login_expression, "returnByValue": True})
            time.sleep(2)
            cdp.navigate(f"{SITE_URL}wp-admin/admin.php?page=chitayka-content")
            cdp.call(
                "Runtime.evaluate",
                {
                    "expression": """
                        (() => {
                            const bar = document.getElementById('wpadminbar');
                            if (bar) bar.remove();
                            document.documentElement.style.marginTop = '0';
                            window.scrollTo(0, 0);
                            return true;
                        })()
                    """,
                    "returnByValue": True,
                },
            )
            time.sleep(0.5)
            cdp.screenshot("08-wordpress-editor.png")

if __name__ == "__main__":
    main()
