# -*- coding: utf-8 -*-
# Put /home/boukhdha/anaconda3/lib/python3.4/site-packages in PYTHONPATH
from flask import Flask, render_template
from slimish_jinja import SlimishExtension
import settings.settings_parameters as settings
import os
import genes

app = Flask(__name__)

@app.route('/')
def show_home():
    settings.PAPERS = None
    if os.path.exists(os.getcwd() + settings.NEUROSYNTH_IMAGE):
        os.remove(os.getcwd() + settings.NEUROSYNTH_IMAGE)
    return render_template('index.html')

Flask.jinja_options['extensions'].append(SlimishExtension)
genes.add_routes(app)

if __name__ == "__main__":
     app.run()
     if os.path.exists(os.getcwd() + settings.NEUROSYNTH_IMAGE):
        os.remove(os.getcwd() + settings.NEUROSYNTH_IMAGE)



