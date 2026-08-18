#!/usr/bin/env bash
# Проверка синтаксиса всех PHP-файлов темы chitayka.
set -u

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
THEME="$ROOT/wp-content/themes/chitayka"

if ! command -v php >/dev/null 2>&1; then
  echo "ERROR: php не найден в PATH" >&2
  exit 2
fi

fail=0
while IFS= read -r -d '' f; do
  if ! php -l "$f" >/dev/null 2>&1; then
    echo "SYNTAX ERROR: $f"
    php -l "$f"
    fail=1
  else
    echo "OK: ${f#$ROOT/}"
  fi
done < <(find "$THEME" -name '*.php' -print0)

if [ "$fail" -ne 0 ]; then
  echo "PHP syntax check FAILED"
  exit 1
fi
echo "PHP syntax check passed"
exit 0
