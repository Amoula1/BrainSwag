# -*- coding: utf-8 -*-
from flask import Flask, render_template
from slimish_jinja import SlimishExtension
import genes

app = Flask(__name__)

#@app.route('/')
#def search():
#    return render_template('index.html')

@app.route('/')
def show_home():
    return render_template('index.html')


Flask.jinja_options['extensions'].append(SlimishExtension)
genes.add_routes(app)

if __name__ == "__main__":
    app.run()


