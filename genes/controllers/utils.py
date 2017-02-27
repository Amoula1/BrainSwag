# -*- coding: utf-8 -*-
from selenium import webdriver
import urllib
import os
import time

def search_in_neurosynth(symbol, settings, requests):
    # look for the name of the gene in a json file
    # and load it here, I can also do the search by ID
    # instead of the gene symbol

    # search for data(the Nifti image of genomics) from Neurosynth

    cwd = os.getcwd()
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
    #urllib.request, in the latest versions of python
    urllib.urlretrieve(url_image, cwd + "/static/data/gene_expressions.nii.gz")
    # os.remove(filePath) to delet the file after use
    images = [{
        'id': id_img_gene,
        'name': symbol,
        'url': '../static/data/MNI152.nii.gz',
        'colorPalette': 'grayscale',
        'cache': True,
        'intent': 'Intensity:'
        }]

    return images
"""
def download_nifti_brainspell():
    cwd = os.getcwd()
    download_dir = cwd + "/static/data/"

    FirefoxProfile fxProfile = new FirefoxProfile();
    fxProfile.setPreference("browser.download.manager.showWhenStarting",false);
    fxProfile.setPreference("browser.download.dir","c:\\mydownloads");
    fxProfile.set_preference("browser.helperApps.neverAsk.saveToDisk", "application/octet-stream");
    browser = webdriver.Firefox(firefox_profile=fp)
    browser.get("http://pypi.python.org/pypi/selenium")
    # you can use your url here
    browser.find_element_by_partial_link_text("selenium-2").click()
    # Use your method to identify class or link text here
    browser.close();

    #fxProfile.setPreference("browser.download.folderList",2);

    WebDriver driver = new FirefoxDriver(fxProfile);
    driver.navigate().to("http://www.foo.com/bah.csv");
"""

def search_in_brainspell(symbol):
    driver = webdriver.PhantomJS()
    ## Integration to the search of the brainspell engine
    url_brainspell = 'http://brainspell.org/search?query=' + symbol
    driver.get(url_brainspell)
    time.sleep(1)
    for a in driver.find_elements_by_tag_name('a'):
        if str(a.get_attribute('href')).find('article') != -1:
            paper_link = str(a.get_attribute('href'))
            paper_name = str(a.get_attribute('innerHTML'))
            print('-- paper name: ', paper_name)
            print('--paper link:', paper_link)

    for p in driver.find_elements_by_class_name('info'):
        paper_authors = p.get_attribute('innerHTML')
        print('--paper authors:', paper_authors)

    #automate a real browser, headless (PhantomJ)S) or not, using selenium
    driver.find_element_by_class_name('download_nii').click()
    #download_nii = driver.find_element_by_class_name('download_nii')
    #print(('--download_nii: ', download_nii))
    #href_nifti_brainspell = download_nii.get_attribute("href")
    #print("--href: ", href_nifti_brainspell)
    #download_link = download_nii.get_attribute("download")
    #print("--download_link:", download_link)

    driver.quit()




