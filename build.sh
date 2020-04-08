#!/bin/sh
VERSION=${1:-develop}

zip -r -9 dist/gruseltourleipzig-twentytwenty-$VERSION.zip src \
    -x */.DS_Store \
    -x */.git \
    -x */.svn \
    -x */.idea \
    -X */__MACOSX