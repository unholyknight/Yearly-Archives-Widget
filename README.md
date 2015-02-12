Yearly Archives Widget for [WordPress](https://wordpress.org/)
==============================================================

Overview
--------

This widget displays WordPress post archives by year and by month. One encapsulating unordered list contains the years and each year contains an unordered list of that year's months.

This widget **only includes HTML markup**. It does not not include JavaScript or CSS. It's up to you to customize this with your own styles and JavaScript.

List Structure
--------------

```html
<ul class="yearly-archives">
  <li>YEAR LINK
    <ul class="monthly-archives">
      <li>MONTH LINK</li>
    </ul>
  </li>
</ul>
```

Compatibility
-------------

Developed and tested for WordPress 4.0+. This widget likely works for WordPress 3.0+ as well, but I haven't done any specific testing with older WordPress versions.