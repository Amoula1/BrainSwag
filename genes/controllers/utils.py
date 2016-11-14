# -*- coding: utf-8 -*-
from selenium import webdriver
import time

def search_in_brainspell(symbol):
    driver = webdriver.PhantomJS()
    ## Integration to the search of the brainspell engine
    url_brainspell = 'http://brainspell.org/search?query=' + symbol
    driver.get(url_brainspell)
    time.sleep(300)
    download_nii = driver.find_element_by_class_name('download_nii')
    print('--download_nii: ', download_nii)
    href_nifti_brainspell = download_nii.get_attribute("href")
    print("--href: ", href_nifti_brainspell)
    download_link = download_nii.get_attribute("download")
    print("--download_link:", download_link)
    driver.quit()
