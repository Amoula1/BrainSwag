# -*- coding: utf-8 -*-
import os
from os.path import join, dirname
import sys

# The root location of the app. Should not need to be changed.
ROOT_DIR = os.path.realpath(
    join(join(os.path.dirname(__file__), os.path.pardir), os.path.pardir))

# Static content
STATIC_FOLDER = join(ROOT_DIR, 'static')

# Templates
TEMPLATE_FOLDER = join(ROOT_DIR, 'templates')

# Neurosynth website
NEUROSYNTH_URL = 'http://neurosynth.org'