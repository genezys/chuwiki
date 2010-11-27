#!/bin/bash
ZIP=chuwiki-$1.zip
hg archive --type zip --exclude '.hg*' --exclude '*.sh' --rev $1 $ZIP
