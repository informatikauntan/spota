/*****************************************/
// Name: Javascript Textarea HTML Editor
// Version: 1.1
// Author: Balakrishnan
// Last Modified Date: 26/12/2008
// License: Free
// URL: http://www.corpocrat.com
/******************************************/

var textarea;
var content;
document.write("<link href=\"styles.css\" rel=\"stylesheet\" type=\"text/css\">");


function Init(obj,width,height,val)
{
  document.write("<table>");
  document.write("<tr bgcolor=\"#E8F1FF\"><td align=\"center\">");
  document.write("<img class=\"button\" src=\"images/bold.png\" name=\"btnBold\" onClick=\"doAddTags('<strong>','</strong>')\">");
  document.write("<img class=\"button\" src=\"images/italic.png\" name=\"btnItalic\" onClick=\"doAddTags('<em>','</em>')\">");
  document.write("<img class=\"button\" src=\"images/underline.png\" name=\"btnUnderline\" onClick=\"doAddTags('<u>','</u>')\">");
  document.write("<img class=\"button\" src=\"images/paragraph.png\" name=\"btnParagraph\" onClick=\"doAddTags('<p>','</p>')\">");	
  document.write("<img class=\"button\" src=\"images/h2.png\" name=\"btnCapital\" onClick=\"doAddTags('<h2>','</h2>')\">");
  document.write("<img class=\"button\" src=\"images/link.png\" name=\"btnLink\" onClick=\"doURL()\">");
  document.write("</td></tr>");
  document.write("<tr><td>");
  document.write("<textarea id=\""+ obj +"\" name = \"" + obj + "\" cols=\"" + width + "\" rows=\"" + height + "\" onKeyup=\"doBreak(event)\"></textarea>");
  document.write("</td></tr></table>");
  textarea = document.getElementById(obj);
  textarea.value = val;
    }

function doURL()
{
var sel;
var url = prompt('Enter the URL:','http://');
var scrollTop = textarea.scrollTop;
var scrollLeft = textarea.scrollLeft;

  if (document.selection)
      {
        textarea.focus();
        var sel = document.selection.createRange();

        if(sel.text==""){
          sel.text = '<a href="' + url + '">' + url + '</a>';
          } else {
          sel.text = '<a href="' + url + '">' + sel.text + '</a>';
          }
        //alert(sel.text);

      }
   else
    {
    var len = textarea.value.length;
      var start = textarea.selectionStart;
    var end = textarea.selectionEnd;

    var sel = textarea.value.substring(start, end);

    if(sel==""){
    sel=url;
    } else
    {
        var sel = textarea.value.substring(start, end);
    }
      //alert(sel);


    var rep = '<a href="' + url + '">' + sel + '</a>';;
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
    textarea.scrollTop = scrollTop;
    textarea.scrollLeft = scrollLeft;
  }
}

function doBreak(e)
{
  if (document.selection)
      {       
		if(e.keyCode=='13')
		{
		textarea.focus()
		var sel = document.selection.createRange();
		sel.text = sel.text + '<br>';
		}      
	 }
   else
    {  // Code for Mozilla Firefox
    if(e.keyCode=='13')
		{
		var len = textarea.value.length;
		var start = textarea.selectionStart;
		var end = textarea.selectionEnd;
	
		var scrollTop = textarea.scrollTop;
		var scrollLeft = textarea.scrollLeft;
	
		var sel = textarea.value.substring(start, end);
		  //alert(sel);
		var rep = sel + '<br>';
			textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);
	
		textarea.scrollTop = scrollTop;
		textarea.scrollLeft = scrollLeft;
		}
  }
}

function doAddTags(tag1,tag2)
{

  // Code for IE
    if (document.selection)
      {
        textarea.focus();
        var sel = document.selection.createRange();
        //alert(sel.text);
        sel.text = tag1 + sel.text + tag2;
      }
   else
    {  // Code for Mozilla Firefox
    var len = textarea.value.length;
      var start = textarea.selectionStart;
    var end = textarea.selectionEnd;

    var scrollTop = textarea.scrollTop;
    var scrollLeft = textarea.scrollLeft;

        var sel = textarea.value.substring(start, end);
      //alert(sel);
    var rep = tag1 + sel + tag2;
        textarea.value =  textarea.value.substring(0,start) + rep + textarea.value.substring(end,len);

    textarea.scrollTop = scrollTop;
    textarea.scrollLeft = scrollLeft;
  }
}

