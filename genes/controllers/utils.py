# -*- coding: utf-8 -*-
from selenium import webdriver
import settings.settings_parameters as settings
import urllib
import os
import time
from papers import paper
from genes import gene

def search_in_neurosynth(symbol, settings, requests):
    # look for the name of the gene in a json file
    # and load it here, I can also do the search by ID
    # instead of the gene symbol

    # search for data(the Nifti image of genomics) from Neurosynth

    cwd = os.getcwd()
    root_url = settings.NEUROSYNTH_URL
    api_url = root_url + '/api/v2'
    gene_json_url = api_url + '/genes/?symbol=' + symbol
    neurosynth_gene_url = settings.NEUROSYNTH_GENE_URL + symbol
    print('-- Gene Json url:', gene_json_url)
    r = requests.get(gene_json_url)
    json_gene = r.json()['data']
    print('-- json_gene:', json_gene)
    id_img_gene = json_gene[0]['images'][0]
    locus_type = json_gene[0]['locus_type']
    name = json_gene[0]['name']
    synonyms = json_gene[0]['synonyms']
    g = gene(neurosynth_gene_url, symbol, str(locus_type), str(name), synonyms)
    print('symbol:', symbol)
    print('Locus type:', locus_type)
    print('Name:', name)
    print('Synonyms:', synonyms)
    print('-- Id img gene:', id_img_gene)
    sub_url_image = '/images/%s' % id_img_gene
    url_image = root_url + sub_url_image
    print('-- url image:', url_image)
    #urllib.request, in the latest versions of python
    urllib.urlretrieve(url_image, cwd + settings.NEUROSYNTH_IMAGE)
    return g

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
    url_brainspell = settings.QUERY_BRAINSPELL + symbol
    driver.get(url_brainspell)
    time.sleep(1)
    papers = []

    for a in driver.find_elements_by_tag_name('a'):
        if str(a.get_attribute('href')).find('article') != -1:
            paper_link = str(a.get_attribute('href'))
            paper_name = str(a.get_attribute('innerHTML'))
            p = paper(paper_name, paper_link)
            print('-- paper name: ', p.name)
            print('--paper link:', p.link)
            papers.append(p)

    #for p in driver.find_elements_by_class_name('info'):
    #    paper_authors = p.get_attribute('innerHTML')
    #    authors.append(paper_authors)
    #    print('--paper authors:', paper_authors)

    #automate a real browser, headless (PhantomJ)S) or not, using selenium
    #WebDriverWait wait = new WebDriverWait(driver,30)
    #wait.until(ExpectedConditions.presenceOfElementLocated(By.id("hplogo")));
    driver.find_element_by_class_name('download_nii').click()
    #download_nii = driver.find_element_by_class_name('download_nii')
    #print(('--download_nii: ', download_nii))
    #href_nifti_brainspell = download_nii.get_attribute("href")
    #print("--href: ", href_nifti_brainspell)
    #download_link = download_nii.get_attribute("download")
    #print("--download_link:", download_link)
    driver.quit()
    if papers[0] == None:
        return None, None
    return papers




