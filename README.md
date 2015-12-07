XSeek Front-End
========================
The front-end for XSeek, an XML-based search engine being developed at NJIT

<b>Note:</b> You cannot view this website properly without having the XSeek program installed properly on your computer first. Screenshots will soon be posted below to show comparisons between the current front-end and the old front-end, which is currently running at the demo URL below.

URL to Demo: http://xseek.njit.edu/

URL to More Information: https://web.njit.edu/~ychen/xseek.htm

<br>
Things Completed This Week:
----------------------
- [x] Created a new "dataset" variable in index.php which determines the dataset being used. Changing the value in index.php will change it for the rest of the website. This allows you to change the dataset being used by changing one variable, whereas many variables had to be changed in the past.
- [x] Fixed some bugs in the feedback form and made it look a little nicer.
- [x] Lines are no longer drawn to child nodes that do not exist.
- [x] You can no longer submit a blank query to XSeek, which was causing PHP errors before (another fix may be required for Safari because Safari does not currently support the 'required' attribute that made this possible).
- [x] The 'Compare Results' button is now disabled until two or more search results are checked off. Previously, errors were displayed when the button was pressed without any search results selected.
- [x] Modified the margins on index.php to make it look more centered.
- [x] The arrow buttons for scrolling through child nodes are now highlighted when moused over. I plan to add this functionality to all nodes as well.

<br>
Major Things to be Completed:
----------------------
- [ ] Get the search.php to generate nodes from the new XSeek output files (this updated output file will likely be easier to parse and will fix some of the current search result problems).
- [ ] Rather than displaying all child nodes from a given search result at once, display the top n results, and create a button to view the rest if the user would like.
- [ ] Denote child nodes that contain information with an arrow rather than a +. The + and - symbols will exclusively be for expanding nodes that do not already contain information.
- [ ] Shorten the amount of space that root nodes take up when expanded. This will require some rewrites of the node expansion system to avoid scrollbars appearing in places that we do not want them.

<br>
Things to be Completed if Time Permits:
----------------------
- [ ] Add a textbox to view a variable amount of child nodes under a parent node.
- [ ] Add scrollbars under sets of child nodes to quickly navigate through them.
- [ ] Fully clean up any deprecated HTML (this will take a while because there is a lot of code to cover).
