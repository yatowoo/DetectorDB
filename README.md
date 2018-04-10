# DetectorDB

This page is a brief introduction for DetectorDB, which provides a web viewer to show records and test results of our detectors. It is comprised of a main table ([bootstrap-table](https://github.com/wenzhixin/bootstrap-table)), an image viewer ([baguetteBox.js](https://github.com/feimosi/baguetteBox.js)) and a ROOT file browser ([jsroot](https://github.com/root-project/jsroot/)). For more details about the implementation, you can have a look at the corresponding repository on GitHub.

Slides for test setup and summary of STAR-EPD at USTC are here ([RXB](https://github.com/yatowoo/DetectorDB/wiki/media/RXBoardTest-ZLiang.pdf), [FEE & SiPM](https://github.com/yatowoo/DetectorDB/wiki/media/FEETest-KFShen.pdf)). Furthermore, the following description will be based on this slide as an illustration.

## Table
![No Image](https://github.com/yatowoo/DetectorDB/wiki/media/MainTable-FEE.png "Main table for FEE")

The main table includes four parts as follows :
* __Sidebar__ : A group of panels linked to different tables.
* __Content__ : In this part, I only insert a list of essential values into the body. Mark '+' in the left of each row is a switch for some extra information, such as pedestal values **(unit: mV)** of FEE, operation current of RXB and result of visual test of SiPM (with theree measurements to determine the welding quality). Every 'SHOW' button points to a new page for jsroot (FEE & SiPM) or image viewer (RXB).

![No Image](https://github.com/yatowoo/DetectorDB/wiki/media/MainTable-DetailView-FEE.png "Detial view for FEE")
![No Image](https://github.com/yatowoo/DetectorDB/wiki/media/MainTable-DetailView-RXB.png "Detial view for RXB")
![No Image](https://github.com/yatowoo/DetectorDB/wiki/media/MainTable-DetailView-SiPM.png "Detial view for SiPM")

* __Toolbar__ : It contains a search box and some buttons (refresh, toggle, columns and save-as). For this version, I haven't yet developed any special function for them.

![No Image](https://github.com/yatowoo/DetectorDB/wiki/media/MainTable-Search-FEE.png "Example of search box")

* __Pagination__ : The number of rows is 16 as default, since one SiPM board contains 16 SiPMs. You can change this value within an  option list [1, 10, 16, 20, 50, All].
	
## Image viewer

Since the receiver boards were tested by DSO directly, we only storaged screenshots of noise FFT and signal amplititude histogram as result. Click the 'SHOW' button in RXB table, it would open a new tab with a grid of images. There is two tips as follow :

* When you hover over a picture, it would display a title like 'Channel 0'.
* Click the picture and get a full-screen viewer with caption in the bottom.
		
## JSROOT
> "JavaScript ROOT provides interactive ROOT-like graphics in the web browsers. Data can be read and displayed from binary and JSON ROOT files."

At present, the browser is a simple url call to the official demo. So I have to face with many limitations. In next version, a new application on jsroot should be took into account.

![No Image](https://github.com/yatowoo/DetectorDB/wiki/media/JSROOT-SetLogy.png "Detial view for FEE")

The result file of FEE includes 5 histograms for each channel, noise, pedestal and charge of signal (intergration). **For noise FFT histogram, you should right click the y axis and enable the option 'SetLogy' mannually.** All x-axis is waveform value measured by  digitizer.

As for SiPM, there is a graph of UI curve (microamp vs. volt) as well as a histogram of signal.
	
# About

For any issue, please contact with <torrence@mail.ustc.edu.cn>.