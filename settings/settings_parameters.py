# -*- coding: utf-8 -*-
import os
from os.path import join, dirname
import sys

# The root location of the app. Should not need to be changed.
ROOT_DIR = os.path.realpath(
    join(join(os.path.dirname(__file__), os.path.pardir), os.path.pardir))

# static variables
PAPERS = {}

# Static content
STATIC_FOLDER = join(ROOT_DIR, 'static')

# Templates
TEMPLATE_FOLDER = join(ROOT_DIR, 'templates')

# integration of other search engines
NEUROSYNTH_URL = 'http://neurosynth.org'
NEUROSYNTH_GENE_URL = 'http://neurosynth.org/genes/'
NEUROSYNTH_IMAGE = '/static/data/gene_expressions.nii.gz'
QUERY_BRAINSPELL = 'http://brainspell.org/search?query='