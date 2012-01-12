Niceforms
==

**Important:**
In its current form, Niceforms is more than 3 years old and becoming more and more obsolete given the ever increasing browser support for CSS3 and other modern techniques. Use at your own risk!

Web forms. Everybody knows web forms. Each day we have to fill in some information in a web form, be it a simple login to your webmail application, an online purchase, or signing up for a website. They are the basic, and pretty much the only way of gathering information on the web.

You basically know a web form when you see one as they always look the same and they’ve kept this look over the years. Try as hard as you might but web forms can only change their appearance so much. Some may argue that this is a good usability feature, and I tend to agree, but there comes a time when you just need to style web forms so that they look different. How do you do that? Niceforms comes to the rescue!

Niceforms is a script that will replace the most commonly used form elements with custom designed ones. You can either use the default theme that is provided or you can even develop your own look with minimal effort.

The script will basically transform this:
![unstyled web form](http://www.emblematiq.com/lab/niceforms/i_niceforms_01.gif)
into this (or whatever you want it to look like):
![Niceforms styled web form](http://www.emblematiq.com/lab/niceforms/i_niceforms_02.gif)

### How Does It Work?

The idea is simple: since normal input fields (including radio buttons, checkboxes, textareas, etc) can only be styled to a small degree, they have to be hidden and their visual appearance replaced with similar working, new, fully customizable constructs. In theory, that doesn't sound really complicated. But from theory to practice there is a long way.

Starting with the basic XHTML code for a web form, Niceforms parses the DOM tree, gets all the input fields, hides them, and positions their new graphical appearance in place. All this is done while preserving the date transfer and selection features of the regular form. Everything is done via javascript.

Take a look at the [demo](http://www.emblematiq.com/lab/niceforms/demo/v20/niceforms.html) and see for yourself.

### Features

Niceforms works just like your regular web form. The form fields and the buttons created are fully scalable. You can specify their width (and height for textareas) through regular HTML properties such as `size`, `cols` and `rows`. Buttons will automatically expand to accommodate the amount of text present. Keyboard-only navigation is also supported.

### Compatibility

The script is fully compatible and has been tested with most major browsers, with the exception of IE6.

### Themes

You can customize the look of your forms in any way you want by creating your own themes. Since Niceforms replaces the form elements with images, it’s just a matter of slicing these images up correctly and creating the CSS that holds them all together. More themes are on the way and you’re more than welcome to contribute as well. A short guide on how to properly create themes is in progress and should be available soon.

### Getting Started

Niceforms is applied to all forms that have the class “niceform”. You can have other classes in there as well but one of them has to be “niceform” in order for the script to work. One of the important aspects of the script is that it requires a correctly coded form, including properly declared labels and values. There’s not much room for error and, if anything, it will force you to code your forms correctly.

See the help section for more information on how to implement and customize Niceforms.

Help
---

Let me start by saying this: Niceforms isn't for everyone! It is only intended for web professionals as a method to spice up certain form elements. While the script tries to accommodate a wide range of user scenarios, due to browser inconsistencies and various other limitations, full scale testing is absolutely recommended for determining whether Niceforms is a good fit for a specific situation. Improper implementation can cause major usability issues. That being said, I will not address simple questions like "How do I use it on my page?". If you can't figure that out you probably shouldn't be using the script anyway. Sorry for being blunt.

### Using Niceforms

Niceforms is magically applied to all forms that have the class “niceform”. You can have other classes in there as well but one of them has to be “niceform” in order for the script to work. One of the important aspects of the script is that it requires a correctly coded form, including properly declared labels and values. There’s not much room for error and, if anything, it will force you to code your forms correctly.

### Browser Compatibility

Niceforms is fully compatible with most modern browsers: IE7+, Firefox2+, Safari3+, Opera9+, Chrome0.3+, Mozilla1.5+, Camino1.6+.
Please note that it is **not compatible with IE6**.

### Concept Overview

Niceforms uses the javascript object model to extend form elements by adding a suite of custom attributes and functions to each of them. These custom elements usually contain the new graphical appearance, while the added functions handle things like the focus effects, data handling, as well as the loading and unloading of the script. Apart from addressing unique characteristics of each individual type of form elements, all element extending functions share a similar structure.

Let's look at the `inputText(el)` function. It's the function that extends regular text-type input fields. The first 9 lines create and append new graphical elements to the original input field:

```js
el.oldClassName = el.className;
el.left = document.createElement('img');
el.left.src = imagesPath + "0.png";
el.left.className = "NFTextLeft";
el.right = document.createElement('img');
el.right.src = imagesPath + "0.png";
el.right.className = "NFTextRight";
el.dummy = document.createElement('div');
el.dummy.className = "NFTextCenter"; 
```

These new graphical elements represent the 2 ends, left and right, and also the middle section of the field. The naming conventions are pretty much self-explanatory. Form elements other than this text-type input may use different new graphic elements, but the idea behind this section remains the same.

The following 2 subfunctions, `onfocus()` and `onblur()` handle the background change that occurs when the field has been focused on, basically by changing its background:

```js
el.onfocus = function() {
this.dummy.className = "NFTextCenter NFh";
this.left.className = "NFTextLeft NFh";
this.right.className = "NFTextRight NFh";
}
el.onblur = function() {
this.dummy.className = "NFTextCenter";
this.left.className = "NFTextLeft";
this.right.className = "NFTextRight";
} 
```

**Attention:**
These will overwrite any other custom `onfocus` and/or `onblur` events that you may have set up for the text-type input fields. To solve this issue you will have to integrate those custom functions within the ones from Niceforms. The same applies to all other form elements that require additional event handling functions (more about this in the next section).

Last 2 subfunctions, `init()` and `unload()`, represent the start and stop actions:

```js
el.init = function() {
this.parentNode.insertBefore(this.left, this);
this.parentNode.insertBefore(this.right, this.nextSibling);
this.dummy.appendChild(this);
this.right.parentNode.insertBefore(this.dummy, this.right);
this.className = "NFText";
}
el.unload = function() {
this.parentNode.parentNode.appendChild(this);
this.parentNode.removeChild(this.left);
this.parentNode.removeChild(this.right);
this.parentNode.removeChild(this.dummy);
this.className = this.oldClassName;
} 
```

These are common to all form elements. `init()` basically adds the new elements to the page, thus making Niceforms replace the existing form, while `unload()` removes these elements, reverting to the original form.

### Custom Event Handling

As explained in the previous section, Niceforms overwrites certain events in order to function correctly. To make the script work with any additional event handling functions that you may have set up, you will need to add those to their respective counterparts within Niceforms.

For instance, let's say you want to perform some type of on-the-fly validation of text-type input fields. In order to do this, you would be using the `onblur` event but that is one of the events overwritten by Niceforms. To integrate the two, first you would need to locate the existing event function within Niceforms. This would be `el.onblur()` within the `inputText()` function. You can simply add your extra code in there and everything should be fine.

```js
el.onblur = function() {
this.dummy.className = "NFTextCenter";
this.left.className = "NFTextLeft";
this.right.className = "NFTextRight";
//add any additional custom code here
} 
```

The same method applies to all the other events on different form elements. Do note that various elements overwrite various events. A full list is available below:

<table>
	<tr><th>Element</th><th>Overwritten Element</th></tr>
	<tr><td>input type="text"</td><td>onblur(), onfocus()</td></tr>
	<tr><td>input type="radio"</td><td>onclick(), onblur(), onfocus()</td></tr>
	<tr><td>input type="checkbox"</td><td>onclick(), onblur(), onfocus()</td></tr>
	<tr><td>input type="submit"</td><td>omnouseout(), onmouseover()</td></tr>
	<tr><td>input type="file"</td><td>onblur(), onfocus()</td></tr>
	<tr><td>textarea</td><td>onblur(), onfocus()</td></tr>
	<tr><td>select</td><td>onblur(), onfocus()</td></tr>
	<tr><td>button</td><td>onmouseout(), onmouseover()</td></tr>
</table>

### Implementing a Jump Menu

By default, Niceforms overrides the `onchange` attributes of any drop down options, thus making a classic jump menu unusable. However, there is a quick workaround.

Add a custom class name to that particular select element (i.e. `class="NFOnChange"`) so that the script can separate it from all the other regular select elements. Within the `option(el, no)` function, add the following code:

```js
el.lnk._onclick = el.onclick || function () {
if(this.ref.oldClassName == "NFOnChange") {
//insert your code here
}}; 
```

Instead of the commented line simply insert your own custom javascript that should be executed when that particular option is selected.

### Window Events

Niceforms also makes use of the `window.onload()` and `window.onresize()` events. These, however, will not overwrite any other existing similar events and will pass them on accordingly if they exist.

### After Implementation

Since the (X)HTML code for your form isn't altered in any way by Niceforms, everything should work just like in the original. That being said, it is entirely up to you to handle what the form does with the data and how it passes it on to a server-side script. One of the questions I'm getting fairly often is why the "vars.php" file from the demo is not included in the distribution. All that script does is return the values you've entered for testing purposes. You should replace it with whatever it is you want your form to do. And again, if you don't know how an (X)HTML form should be used and implemented properly, you're probably just going to make things worse by using Niceforms.

### Themes

As more themes are being developed, a ready-sliced PSD template for the default Niceforms theme is already included with the latest distribution. You can use it as a starting point and create your own theme. After modifying it, if you've kept the original element sizes intact, just hit Save for Web, choose "Images Only", "Default Settings" and "All Slices" in the Save dialog and it will automatically create all the necessary images with the correct names. If, however, you do modify the size of various elements, you'll have to change the size of those slices as well.

I am currently working on a more detailed guide on how to develop custom themes and hopefully it will be available by the end of the year.