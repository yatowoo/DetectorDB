# DetectorDB

This page is a brief introduction for DetectorDB, which provides a web viewer to show records and test results of our detectors. It is comprised of a main table (bootstrap-table), an image viewer (baguetteBox.js) and a ROOT file browser (jsroot). For more details about the implementation, you can have a look at the corresponding repository on GitHub.

A slide for test setup and summary of STAR-EPD is here. [ppt/pdf] Furthermore, the following description will be based on this slide as example.

## Table

The main table includes four parts as follows : [Fig*]
* Sidebar : A group of panels linked to different tables.
* Content : In this part, I only insert a list of essential values into the body. Mark '+' in the left of each row is a switch for some extra information, such as pedestal values (unit: mV) of FEE, operation current of RXB and result of visual test of SiPM (with theree measurements to determine the welding quality). Every 'SHOW' button points to a new page for jsroot (FEE & SiPM) or image viewer (RXB). [Fig*]
* Toolbar : It contains a search box [Fig*] and some buttons (refresh, toggle, columns and save-as). For this version, I haven't yet developed any special function for them.
* Pagination : The number of rows is 16 as default, since one SiPM board contains 16 SiPMs. You can change this value within an option list [1, 10, 16, 20, 50, All].
	
## Image viewer

Since the receiver boards was tested by DSO directly, we only storaged the screenshots of noise FFT and signal amplititude histogram as result. Click the 'SHOW' button in RXB table, it would open a new tab with a grid of images. There is two tips as follow :

* When you hover over a picture, it would display a title like 'Channel 0'.
* Click the picture and get a full-screen viewer with caption in the bottom.
		
## JSROOT
> "JavaScript ROOT provides interactive ROOT-like graphics in the web browsers. Data can be read and displayed from binary and JSON ROOT files."

At present, the browser is a simple url call to the official demo. So I have to face with many limitations. In next version, a new application on jsroot would be took into account.

The result file of FEE includes 5 histograms for each channel, noise, pedestal and charge of signal (intergration). **For noise FFT histogram, you should right click the y axis and enable the option 'SetLogy' mannually.**[Fig*] All x-axis is waveform value measured by  digitizer.

As for SiPM, there is a graph of UI curve (microamp vs. volt) as well as a histogram of signal.
	
# Acknowledgement

# TODO

# Dependencies

Server
* Apache2
* php5
* jsroot

UI
* Flat UI
* bootstrap-table
* FileSaver
