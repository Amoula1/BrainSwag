# -*- coding: utf-8 -*-
import settings.settings_parameters as settings
from flask import Blueprint, render_template, request
from genes.controllers.utils import search_in_brainspell
from werkzeug.datastructures import ImmutableMultiDict
import requests
import json
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
        # look for the name of the gene in a json file
        # and load it here, I can also do the search by ID
        # instead of the gene symbol

        # search for data(the Nifti image of brain activations) from Neurosynth
        root_url = settings.NEUROSYNTH_URL
        api_url = root_url + '/api/v2'
        url_gene = api_url + '/genes/?symbol=' + symbol
        print('-- Gene metadata url:', url_gene)
        r = requests.get(url_gene)
        json_gene = r.json()['data']
        print('-- json_gene:', json_gene)
        id_img_gene = json_gene[0]['images'][0]
        print('-- Id img gene:', id_img_gene)
        sub_url_image = '/images/%s' % id_img_gene
        url_image = root_url + sub_url_image
        print('-- url image:', url_image)
        images = [{
            'id': id_img_gene,
            'name': symbol,
            'url': sub_url_image,
            'colorPalette': 'intense red-blue',
            'download': sub_url_image,
            'sign': 'both'
        }]



        # search for data (Nifti image of gene expression)
        #search_in_brainspell(symbol) ## Uncomment this later !

        # route to the view: display the two images together
        #return render_template('hello.html')

        return render_template('show.html.slim',
                    images=json.dumps(images),
                    symbol=symbol, image_id=id_img_gene)

## HERE
# add another function search_engine() to show the page of searching for a gene (the input text)
#add another function integrate_brainspell() that allows to get the ID_image and the nifti image of the brain activations
# change the name of show to integrate to integrate_neurosynth() that allows to get the url of the image .nii related to brain activations
# add a function show() that allows to display the two images superposed

   #init_assets(app)
    app.register_blueprint(blueprint)