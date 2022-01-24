
// -----------------------------------------------
//
function css_presen()
{
   var before  = "print";
   var after   = "presen";

   var tagName = "h2";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "h3";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "table";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "p";
   var before  = "command-print";
   var after   = "command-presen";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "p";
   var before  = "code-print";
   var after   = "code-presen";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "div";
   var before  = "code-print";
   var after   = "code-presen";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "p";
   var fontSizeBefore = "small";
   var fontSizeAfter  = "x-large";
   tagFontSizeSwitch(tagName,fontSizeBefore,fontSizeAfter);

   var tagName = "div";
   var fontSizeBefore = "small";
   var fontSizeAfter  = "x-large";
   tagFontSizeSwitch(tagName,fontSizeBefore,fontSizeAfter);

   var tagName = "ul";
   var fontSizeBefore = "small";
   var fontSizeAfter  = "x-large";
   tagFontSizeSwitch(tagName,fontSizeBefore,fontSizeAfter);

   var tagName = "blockquote";
   var fontSizeBefore = "small";
   var fontSizeAfter  = "x-large";
   tagFontSizeSwitch(tagName,fontSizeBefore,fontSizeAfter);
}

// -----------------------------------------------
//
function css_print()
{
   var before  = "presen";
   var after   = "print";

   var tagName = "h2";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "h3";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "table";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "p";
   var before  = "command-presen";
   var after   = "command-print";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "p";
   var before  = "code-presen";
   var after   = "code-print";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "div";
   var before  = "code-presen";
   var after   = "code-print";
   tagClassNameSwitch(tagName,before,after);

   var tagName = "p";
   var fontSizeBefore = "x-large";
   var fontSizeAfter  = "small";
   tagFontSizeSwitch(tagName,fontSizeBefore,fontSizeAfter);

   var tagName = "div";
   var fontSizeBefore = "x-large";
   var fontSizeAfter  = "small";
   tagFontSizeSwitch(tagName,fontSizeBefore,fontSizeAfter);

   var tagName = "ul";
   var fontSizeBefore = "x-large";
   var fontSizeAfter  = "small";
   tagFontSizeSwitch(tagName,fontSizeBefore,fontSizeAfter);

   var tagName = "blockquote";
   var fontSizeBefore = "x-large";
   var fontSizeAfter  = "small";
   tagFontSizeSwitch(tagName,fontSizeBefore,fontSizeAfter);
}

// ------------------------------------------------
//
function tagClassNameSwitch(tagName,before,after)
{
   var obj = document.getElementsByTagName(tagName);
   obj_length = obj.length;
//alert(obj_length);

   for(i=0; i <obj_length ; i++) 
   {
      if(obj[i].className == before)
      {
         obj[i].className = after;
      }
   }
}

// ----------------------------------------------
//
function tagFontSizeSwitch(tagName,fontSizeBefore,fontSizeAfter)
{
   var obj = document.getElementsByTagName(tagName);
   obj_length = obj.length;
//alert(obj_length);


   for(i=0; i <obj_length ; i++) 
   {
      obj[i].style.fontSize = fontSizeAfter;
/*
      fontSize = obj[i].style.fontSize;

alert(fontSize);
      if(fontSize == fontSizeBefore)
      {
         obj[i].style.fontSize = fontSizeAfter;

      }
*/
   }

}

