#!/usr/bin/env bash

[ -z "$1" ] && { >&2 echo "No war file specified."; exit 1; }
[ -z "$2" ] && { >&2 echo "No target directory specified."; exit 1; }

echo "$(date): Clear target"
rm -rf "$2"/* || { >&2 echo "Could not clear target: $2"; exit 1; }

echo "$(date): Unpack war file"
unzip -qqod "$2" "$1" || { >&2 echo "Could not unpack war file: $1"; exit 1; }

echo "$(date): Thank you for purchasing Aurora!"
