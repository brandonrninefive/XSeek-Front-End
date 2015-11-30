XSeek Front-End
========================
The front-end for XSeek, an XML-based search engine being developed at NJIT

<b>Note:</b> You cannot view this website properly without having the XSeek program installed properly on your computer first. Screenshots will soon be posted below to show comparisons between the current front-end and the old front-end, which is currently running at the demo URL below.

URL to Demo: http://xseek.njit.edu/

URL to More Information: https://web.njit.edu/~ychen/xseek.htm

<br>
Things Completed This Week:
----------------------
- [x] Fixed the page numbers at the bottom of search.php to display in the correct order.
- [x] Fixed all major CSS bugs (the Bootstrap controls no longer try to auto-resize which was messing up a lot of the pages when shrunk down).
- [x] Got rid of the unnecessary contact information and copyright notice on index.php and linked the "About XSeek" link to the updated "about" page.
- [x] All of the controls on search.php are now properly formatted (some of the page's design was also updated).
- [x] The nodes on search.php are now much smaller (they were previously too large).
- [x] When scrolling through a list of child nodes, nodes that do not actually exist will now no longer display an SVG node despite no information for it existing (the lines to these nodes are still drawn, which I plan to fix at a later time).
- [x] Added a placeholder tag above parent nodes which will display their node type when this information becomes available to me.
- [x] An associative array is now used to determine the attributes that different types of nodes will use for their titles. Previously, a regular array was used to determine which attribute to use, but the new associative array system is more reliable. For example, if two node types have an attribute 'name', but you want to use the attribute 'title' as the title for one of the node types and the attribute 'name' for the other, this can now be done. With the old system, it would have to be one or the other, or both.

<br>
Major Things to be Completed:
----------------------
- [ ] Get the search.php to generate nodes from the new XSeek output files (this updated output file will likely be easier to parse and will fix some of the current search result problems).
- [ ] Rather than displaying all child nodes from a given search result at once, display the top n results, and create a button to view the rest if the user would like.
- [ ] Denote child nodes that contain information with an arrow rather than a +. The + and - symbols will exclusively be for expanding nodes that do not already contain information.

<br>
Things to be Completed if Time Permits:
----------------------
- [ ] Add a textbox to view a variable amount of child nodes under a parent node.
- [ ] Add scrollbars under sets of child nodes to quickly navigate through them.
