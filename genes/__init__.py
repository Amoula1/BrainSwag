# -*- coding: utf-8 -*-
import settings.settings_parameters as settings
from flask import Blueprint, render_template, request
from genes.controllers.utils import search_in_brainspell, search_in_neurosynth
from werkzeug.datastructures import ImmutableMultiDict
import requests
import os
#from .util import assets

def add_routes(app=None):
    blueprint = Blueprint('admin', __name__, static_url_path='/genes/static',
                     static_folder='./static', template_folder='./templates')

    @blueprint.route('/search', methods=['GET'])
    def search():
        # get the symbol or the query from the current url
        imd = ImmutableMultiDict(request.args)
        symbol = imd.getlist('symbol')[0]
        symbol = symbol.strip()
        # Step1: search for data (Nifti image of gene expression)
        gene = search_in_neurosynth(symbol, settings, requests)

        # Step2: search_in_brainspell(symbol)
        settings.PAPERS = search_in_brainspell(symbol)

        # route to the view: display the two images together
        # If I want to output the list of papers here I have to change
        # this into a php page !
        return render_template('visualization_images.html', papers = settings.PAPERS, gene = gene)


   #init_assets(app)
    app.register_blueprint(blueprint)

