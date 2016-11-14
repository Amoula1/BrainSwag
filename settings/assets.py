# -*- coding: utf-8 -*-
# consolidated JavaScript bundle
from flask_assets import Bundle, Environment
import settings.settings_parameters as settings

js_bundle = Bundle('js/lib/jquery.js',
                  'js/lib/jquery-ui.js',
                  'js/lib/jquery.cookie.js',
                  'js/lib/jquery.dataTables.min.js',
                  'js/lib/bootstrap.js',
                  'js/lib/setfilterdelay.js',
                  'js/lib/dataTables.tableTools.min.js',
                  # 'js/lib/react-0.12.2.js',
                  'js/lib/react-with-addons-0.13.1.js',
                  'js/lib/underscore-min.js',
                  'js/lib/backbone-min.js',
                  'js/nsviewer/amplify.js',
                  'js/nsviewer/panzoom.js',
                  'js/nsviewer/rainbow.js',
                  'js/nsviewer/sylvester.js',
                  'js/nsviewer/xtk.js',
                  'js/nsviewer/viewer.js',
                   filters='rjsmin', output='js/main.min.js')

def init_assets(app):
    app.config['ASSETS_DEBUG'] = settings.DEBUG
    webassets = Environment(app)
    webassets.register('js', js_bundle)
    #webassets.config['PYSCSS_STATIC_ROOT'] = join(STATIC_FOLDER, 'scss')
    #webassets.config['PYSCSS_STATIC_URL'] = join(STATIC_FOLDER, 'css/main.css')
    #webassets.register('css', css_bundle)
    #webassets.register('coffee', coffee_bundle)
    #webassets.register('swagger_js', swagger_js)
    #webassets.register('swagger_css', swagger_css)