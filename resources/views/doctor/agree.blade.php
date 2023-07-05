@extends('doctor.layouts.register-layout')

@section('title', 'step 2 | information')

@section('content')
    <div id="errors">
        {{-- validation errors will appear here. --}}
    </div>
    <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word"
        xmlns:m="http://schemas.microsoft.com/office/2004/12/omml" xmlns="http://www.w3.org/TR/REC-html40">



    <head>

        <meta http-equiv=Content-Type content="text/html; charset=utf-8">

        <meta name=ProgId content=Word.Document>

        <meta name=Generator content="Microsoft Word 15">

        <meta name=Originator content="Microsoft Word 15">

        <link rel=File-List href="on%20my%20way%20Policy%20and%20Procedure%20agreement%20.fld/filelist.xml">
        <link rel=themeData href="on%20my%20way%20Policy%20and%20Procedure%20agreement%20.fld/themedata.thmx">

        <link rel=colorSchemeMapping
            href="on%20my%20way%20Policy%20and%20Procedure%20agreement%20.fld/colorschememapping.xml">


        <style>
            <!--
            /* Font Definitions */
            span {
                font-size: clamp(0.875rem, calc(0.7459rem + 0.5435vw), 1.1875rem) !important;
                line-height: clamp(1.3125rem, calc(1.0802rem + 0.9783vw), 1.875rem) !important;
            }

            h2 {
                margin-right: 10px !important;
            }


            @font-face {
                font-family: "Cambria Math";

                panose-1: 2 4 5 3 5 4 6 3 2 4;

                mso-font-charset: 0;

                mso-generic-font-family: roman;

                mso-font-pitch: variable;

                mso-font-signature: 3 0 0 0 1 0;
            }

            @font-face {
                font-family: Calibri;

                panose-1: 2 15 5 2 2 2 4 3 2 4;

                mso-font-charset: 0;

                mso-generic-font-family: swiss;

                mso-font-pitch: variable;

                mso-font-signature: -469750017 -1073732485 9 0 511 0;
            }

            /* Style Definitions */

            p.MsoNormal,
            li.MsoNormal,
            div.MsoNormal {
                mso-style-unhide: no;

                mso-style-qformat: yes;

                mso-style-parent: "";

                margin: 0in;

                margin-bottom: .0001pt;

                mso-pagination: widow-orphan;

                font-size: 12.0pt;

                font-family: "Calibri", sans-serif;

                mso-ascii-font-family: Calibri;

                mso-ascii-theme-font: minor-latin;

                mso-fareast-font-family: Calibri;

                mso-fareast-theme-font: minor-latin;

                mso-hansi-font-family: Calibri;

                mso-hansi-theme-font: minor-latin;

                mso-bidi-font-family: Arial;

                mso-bidi-theme-font: minor-bidi;

                mso-ansi-language: EN-AU;
            }

            h1 {
                mso-style-priority: 9;

                mso-style-unhide: no;

                mso-style-qformat: yes;

                mso-style-link: "Heading 1 Char";

                mso-style-next: Normal;

                margin-top: 5.95pt;

                margin-right: 0in;

                margin-bottom: 0in;

                margin-left: 0in;

                margin-bottom: .0001pt;

                mso-pagination: widow-orphan lines-together;

                page-break-after: avoid;

                mso-outline-level: 1;

                font-size: 10.0pt;

                font-family: "Calibri", sans-serif;

                mso-fareast-font-family: Calibri;

                mso-font-kerning: 0pt;

                mso-ansi-language: EN;

                mso-fareast-language: EN-GB;

                mso-bidi-font-weight: normal;
            }

            h2 {
                mso-style-priority: 9;

                mso-style-qformat: yes;

                mso-style-link: "Heading 2 Char";

                mso-style-next: Normal;

                margin-top: 13.05pt;

                margin-right: 71.75pt;

                margin-bottom: 0in;

                margin-left: 23.55pt;

                margin-bottom: .0001pt;

                text-indent: -.05pt;

                line-height: 114%;

                mso-pagination: widow-orphan lines-together;

                page-break-after: avoid;

                mso-outline-level: 2;

                font-size: 10.0pt;

                font-family: "Calibri", sans-serif;

                mso-fareast-font-family: Calibri;

                mso-ansi-language: EN;

                mso-fareast-language: EN-GB;

                font-weight: normal;
            }

            h3 {
                mso-style-priority: 9;

                mso-style-qformat: yes;

                mso-style-link: "Heading 3 Char";

                mso-style-next: Normal;

                margin-top: 6.7pt;

                margin-right: 0 !important;

                margin-bottom: 0in;

                margin-left: clamp(3.125rem, calc(2.3505rem + 3.2609vw), 5rem) !important;

                margin-bottom: .0001pt;

                line-height: 112%;

                mso-pagination: widow-orphan lines-together;

                page-break-after: avoid;

                mso-outline-level: 3;

                font-size: 10.0pt;

                font-family: "Calibri", sans-serif;

                mso-fareast-font-family: Calibri;

                mso-ansi-language: EN;

                mso-fareast-language: EN-GB;

                font-weight: normal;
            }

            h4 {
                mso-style-priority: 9;

                mso-style-qformat: yes;

                mso-style-link: "Heading 4 Char";

                mso-style-next: Normal;

                margin-top: 0in;

                margin-right: .75in;

                margin-bottom: 0in;

                margin-left: 1.5in;

                margin-bottom: .0001pt;

                mso-pagination: widow-orphan lines-together;

                page-break-after: avoid;

                mso-outline-level: 4;

                font-size: 10.0pt;

                font-family: "Calibri", sans-serif;

                mso-fareast-font-family: Calibri;

                mso-ansi-language: EN;

                mso-fareast-language: EN-GB;

                font-weight: normal;
            }

            p.MsoTitle,
            li.MsoTitle,
            div.MsoTitle {
                mso-style-priority: 10;

                mso-style-unhide: no;

                mso-style-qformat: yes;

                mso-style-link: "Title Char";

                mso-style-next: Normal;

                margin-top: 0in;

                margin-right: 0in;

                margin-bottom: 3.0pt;

                margin-left: 0in;

                line-height: 115%;

                mso-pagination: widow-orphan lines-together;

                page-break-after: avoid;

                font-size: 26.0pt;

                font-family: "Arial", sans-serif;

                mso-fareast-font-family: Arial;

                mso-ansi-language: EN;

                mso-fareast-language: EN-GB;
            }

            span.TitleChar {
                mso-style-name: "Title Char";

                mso-style-priority: 10;

                mso-style-unhide: no;

                mso-style-locked: yes;

                mso-style-link: Title;

                mso-ansi-font-size: 26.0pt;

                mso-bidi-font-size: 26.0pt;

                font-family: "Arial", sans-serif;

                mso-ascii-font-family: Arial;

                mso-fareast-font-family: Arial;

                mso-hansi-font-family: Arial;

                mso-bidi-font-family: Arial;

                mso-ansi-language: EN;

                mso-fareast-language: EN-GB;
            }

            span.Heading1Char {
                mso-style-name: "Heading 1 Char";

                mso-style-priority: 9;

                mso-style-unhide: no;

                mso-style-locked: yes;

                mso-style-link: "Heading 1";

                mso-ansi-font-size: 10.0pt;

                mso-bidi-font-size: 10.0pt;

                font-family: "Calibri", sans-serif;

                mso-ascii-font-family: Calibri;

                mso-fareast-font-family: Calibri;

                mso-hansi-font-family: Calibri;

                mso-bidi-font-family: Calibri;

                mso-ansi-language: EN;

                mso-fareast-language: EN-GB;

                font-weight: bold;

                mso-bidi-font-weight: normal;
            }

            span.Heading2Char {
                mso-style-name: "Heading 2 Char";

                mso-style-priority: 9;

                mso-style-unhide: no;

                mso-style-locked: yes;

                mso-style-link: "Heading 2";

                mso-ansi-font-size: 10.0pt;

                mso-bidi-font-size: 10.0pt;

                font-family: "Calibri", sans-serif;

                mso-ascii-font-family: Calibri;

                mso-fareast-font-family: Calibri;

                mso-hansi-font-family: Calibri;

                mso-bidi-font-family: Calibri;

                mso-ansi-language: EN;

                mso-fareast-language: EN-GB;
            }

            span.Heading3Char {
                mso-style-name: "Heading 3 Char";

                mso-style-priority: 9;

                mso-style-unhide: no;

                mso-style-locked: yes;

                mso-style-link: "Heading 3";

                mso-ansi-font-size: 10.0pt;

                mso-bidi-font-size: 10.0pt;

                font-family: "Calibri", sans-serif;

                mso-ascii-font-family: Calibri;

                mso-fareast-font-family: Calibri;

                mso-hansi-font-family: Calibri;

                mso-bidi-font-family: Calibri;

                mso-ansi-language: EN;

                mso-fareast-language: EN-GB;
            }

            span.Heading4Char {
                mso-style-name: "Heading 4 Char";

                mso-style-priority: 9;

                mso-style-unhide: no;

                mso-style-locked: yes;

                mso-style-link: "Heading 4";

                mso-ansi-font-size: 10.0pt;

                mso-bidi-font-size: 10.0pt;

                font-family: "Calibri", sans-serif;

                mso-ascii-font-family: Calibri;

                mso-fareast-font-family: Calibri;

                mso-hansi-font-family: Calibri;

                mso-bidi-font-family: Calibri;

                mso-ansi-language: EN;

                mso-fareast-language: EN-GB;
            }

            span.SpellE {
                mso-style-name: "";

                mso-spl-e: yes;
            }

            span.GramE {
                mso-style-name: "";

                mso-gram-e: yes;
            }

            .MsoChpDefault {
                mso-style-type: export-only;

                mso-default-props: yes;

                font-family: "Calibri", sans-serif;

                mso-ascii-font-family: Calibri;

                mso-ascii-theme-font: minor-latin;

                mso-fareast-font-family: Calibri;

                mso-fareast-theme-font: minor-latin;

                mso-hansi-font-family: Calibri;

                mso-hansi-theme-font: minor-latin;

                mso-bidi-font-family: Arial;

                mso-bidi-theme-font: minor-bidi;

                mso-ansi-language: EN-AU;
            }

            @page WordSection1 {
                size: 595.3pt 841.9pt;

                margin: 1.0in 1.0in 1.0in 1.0in;

                mso-header-margin: 35.4pt;

                mso-footer-margin: 35.4pt;

                mso-paper-source: 0;
            }

            div.WordSection1 {
                page: WordSection1;
            }

            /* List Definitions */

            @list l0 {
                mso-list-id: 460656061;

                mso-list-template-ids: 1477351302;
            }

            @list l0:level1 {
                mso-level-number-format: bullet;

                mso-level-text: ●;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 2.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l0:level2 {
                mso-level-number-format: bullet;

                mso-level-text: ○;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 2.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l0:level3 {
                mso-level-number-format: bullet;

                mso-level-text: ■;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 3.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l0:level4 {
                mso-level-number-format: bullet;

                mso-level-text: ●;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 3.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l0:level5 {
                mso-level-number-format: bullet;

                mso-level-text: ○;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 4.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l0:level6 {
                mso-level-number-format: bullet;

                mso-level-text: ■;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 4.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l0:level7 {
                mso-level-number-format: bullet;

                mso-level-text: ●;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 5.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l0:level8 {
                mso-level-number-format: bullet;

                mso-level-text: ○;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 5.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l0:level9 {
                mso-level-number-format: bullet;

                mso-level-text: ■;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 6.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l1 {
                mso-list-id: 1841114982;

                mso-list-template-ids: 1363947598;
            }

            @list l1:level1 {
                mso-level-number-format: bullet;

                mso-level-text: ●;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 1.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l1:level2 {
                mso-level-number-format: bullet;

                mso-level-text: ○;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 2.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l1:level3 {
                mso-level-number-format: bullet;

                mso-level-text: ■;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 2.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l1:level4 {
                mso-level-number-format: bullet;

                mso-level-text: ●;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 3.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l1:level5 {
                mso-level-number-format: bullet;

                mso-level-text: ○;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 3.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l1:level6 {
                mso-level-number-format: bullet;

                mso-level-text: ■;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 4.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l1:level7 {
                mso-level-number-format: bullet;

                mso-level-text: ●;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 4.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l1:level8 {
                mso-level-number-format: bullet;

                mso-level-text: ○;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 5.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l1:level9 {
                mso-level-number-format: bullet;

                mso-level-text: ■;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 5.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l2 {
                mso-list-id: 1918897721;

                mso-list-template-ids: -1501796434;
            }

            @list l2:level1 {
                mso-level-number-format: bullet;

                mso-level-text: ●;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 1.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l2:level2 {
                mso-level-number-format: bullet;

                mso-level-text: ○;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 2.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l2:level3 {
                mso-level-number-format: bullet;

                mso-level-text: ■;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 2.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l2:level4 {
                mso-level-number-format: bullet;

                mso-level-text: ●;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 3.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l2:level5 {
                mso-level-number-format: bullet;

                mso-level-text: ○;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 3.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l2:level6 {
                mso-level-number-format: bullet;

                mso-level-text: ■;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 4.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l2:level7 {
                mso-level-number-format: bullet;

                mso-level-text: ●;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 4.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l2:level8 {
                mso-level-number-format: bullet;

                mso-level-text: ○;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 5.0in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            @list l2:level9 {
                mso-level-number-format: bullet;

                mso-level-text: ■;

                mso-level-tab-stop: none;

                mso-level-number-position: left;

                margin-left: 5.5in;

                text-indent: -.25in;

                text-decoration: none;

                text-underline: none;
            }

            ol {
                margin-bottom: 0in;
            }

            ul {
                margin-bottom: 0in;
            }
            -->

        </style>

        <!--[if gte mso 10]>

                                    <style>

                                     /* Style Definitions */

                                     table.MsoNormalTable

                                     {mso-style-name:"Table Normal";

                                     mso-tstyle-rowband-size:0;

                                     mso-tstyle-colband-size:0;

                                     mso-style-noshow:yes;

                                     mso-style-priority:99;

                                     mso-style-parent:"";

                                     mso-padding-alt:0in 5.4pt 0in 5.4pt;

                                     mso-para-margin:0in;

                                     mso-para-margin-bottom:.0001pt;

                                     mso-pagination:widow-orphan;

                                     font-size:12.0pt;

                                     font-family:"Calibri",sans-serif;

                                     mso-ascii-font-family:Calibri;

                                     mso-ascii-theme-font:minor-latin;

                                     mso-hansi-font-family:Calibri;

                                     mso-hansi-theme-font:minor-latin;

                                     mso-bidi-font-family:Arial;

                                     mso-bidi-theme-font:minor-bidi;

                                     mso-ansi-language:EN-AU;}

                                    </style>

                                    <![endif]-->

    </head>



    <body lang=EN-US style='tab-interval:.5in'>



        <div class=WordSection1>


            <br>
            <p class=MsoNormal style='margin-left:.5in;text-indent:-.5in'><span lang=EN-AU>Policy

                    and Procedure</span></p>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <p class=MsoTitle style='margin-bottom:0in;margin-bottom:.0001pt;mso-pagination:

lines-together'><b
                    style='mso-bidi-font-weight:normal'><span lang=EN
                        style='font-size:10.0pt;line-height:115%;font-family:"Calibri",sans-serif;

mso-fareast-font-family:Calibri'>THIS
                        AGREEMENT was made</span></b><span lang=EN
                    style='font-size:10.0pt;line-height:115%;font-family:"Calibri",sans-serif;

mso-fareast-font-family:Calibri'>
                    between On My Way Therapy Australia PTY LTD,<b style='mso-bidi-font-weight:normal'> </b><span
                        style='background:white;

mso-highlight:white'>and you (</span>hereinafter referred to as
                    “employee”).<o:p></o:p></span></p>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <p class=MsoTitle style='margin-bottom:0in;margin-bottom:.0001pt;mso-pagination:

lines-together'><a
                    name="_hzfp41xobrgl"></a><b style='mso-bidi-font-weight:

normal'><span lang=EN
                        style='font-size:10.0pt;line-height:115%;font-family:

"Calibri",sans-serif;mso-fareast-font-family:Calibri'>WHEREAS
                    </span></b><span lang=EN
                    style='font-size:10.0pt;line-height:115%;font-family:"Calibri",sans-serif;

mso-fareast-font-family:Calibri'>On
                    My Way Therapy Australia PTY LTD desires to

                    obtain the benefit of the services of the employee, and the employee desires to

                    render such services on the terms and conditions set forth. <o:p></o:p></span></p>



            <p class=MsoTitle style='margin-bottom:0in;margin-bottom:.0001pt;mso-pagination:

lines-together'><a
                    name="_a1jc8uihfkqp"></a><span lang=EN
                    style='font-size:

10.0pt;line-height:115%;font-family:"Calibri",sans-serif;mso-fareast-font-family:

Calibri'>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <p class=MsoTitle style='margin-bottom:0in;margin-bottom:.0001pt;mso-pagination:

lines-together'><a
                    name="_sxrjad1tha1s"></a><b style='mso-bidi-font-weight:

normal'><span lang=EN
                        style='font-size:10.0pt;line-height:115%;font-family:

"Calibri",sans-serif;mso-fareast-font-family:Calibri'>IN
                        CONSIDERATION </span></b><span lang=EN
                    style='font-size:10.0pt;line-height:115%;font-family:"Calibri",sans-serif;

mso-fareast-font-family:Calibri'>of
                    the promises and other good and valuable

                    consideration (the sufficiency and receipt of which are hereby acknowledged)

                    the parties agree as follows:<o:p></o:p></span></p>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <p class=MsoTitle style='margin-bottom:10.0pt;mso-pagination:lines-together'><b
                    style='mso-bidi-font-weight:normal'><span lang=EN
                        style='font-size:10.0pt;

line-height:115%;font-family:"Calibri",sans-serif;mso-fareast-font-family:Calibri'>Terms

                        and Conditions of Employment:<o:p></o:p></span></b></p>



            <p class=MsoNormal
                style='margin-top:0in;margin-right:52.05pt;margin-bottom:

10.0pt;margin-left:0in;mso-pagination:none'>
                <span lang=EN-AU
                    style='font-size:

10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:Calibri;

mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri'>The
                    following terms

                    and conditions of employment represent the agreement between (the employee) and

                    On My Way Therapy Australia PTY LTD on the terms on which the employee will

                    provide her services to On My Way Therapy Australia PTY LTD<o:p></o:p></span>
            </p>



            <h1 style='margin-top:0in;mso-pagination:lines-together'><a name="_1wcu8r9kjn7w"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h1>



            <h1 style='margin-top:0in;mso-pagination:lines-together'><a name="_mq9bl2fmbai7"></a><span lang=EN>1.
                    PARTIES </span></h1>



            <h2><a name="_r8pvqqiepyyi"></a><span lang=EN>1.1. The Employer is On My Way

                    Therapy Australia PTY LTD</span></h2>



            <h2><a name="_mwj5mk21lzpl"></a><span lang=EN>1.2. The employee is (referred to

                    as ‘the employee’). </span></h2>



            <h1 style='margin-top:7.8pt;mso-pagination:lines-together'><a name="_jo17vhimc2tk"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h1>



            <h1 style='margin-top:7.8pt;mso-pagination:lines-together'><a name="_gpka19zcaxkj"></a><span lang=EN>2.
                    DEFINITIONS </span></h1>



            <h2><a name="_fyaneo4v939m"></a><span lang=EN>2.1. ‘We’ or ‘us’ means the Employer

                    and ‘our’ means the Employer’s. </span></h2>



            <h2><a name="_zb2iraxv8059"></a><span lang=EN>2.2. ‘You’ means the employee and

                    ‘your’ means the employee’s. </span></h2>



            <h2><a name="_cfj8gaus1nty"></a><span lang=EN>2.3. ‘The parties’ means the

                    Employer and the employee. </span></h2>



            <h2><a name="_dumbemdl6b0s"></a><span lang=EN>2.4. ‘Month’ means a calendar

                    month. </span></h2>



            <h2><a name="_xbtlijv549uu"></a><span lang=EN>2.5. ‘Performance Criteria’ means

                    the performance criteria to be applied by the Employer when reviewing the

                    performance of the employee. </span></h2>



            <h2><a name="_ru5bepvf17q2"></a><span lang=EN>2.6. ‘Confidential Information’

                    means all the information including trade secrets, Intellectual Property,

                    marketing and business plans, client and supplier lists, computer software

                    applications and programs, business contacts, finance, remuneration details,

                    data concerning the Employer or any of its related entities or any client of

                    the Employer’s, finances, operating margins, prospect’s lists, and transactions

                    of the Employer, but does not include information in the public domain

                    otherwise than through a breach of an obligation of confidentiality.</span></h2>



            <h2><a name="_97d1ck1m4gpj"></a><span lang=EN>2.7. ‘Contract’ means this

                    employment contract.</span></h2>



            <h2><a name="_pnzorj3zgyjv"></a><span lang=EN>2.8. ‘Fair Work Act’ means the

                    Fair Work Act 2009 (<span class=SpellE>Cth</span>).</span></h2>



            <h2><a name="_jbz9pf217wd7"></a><span lang=EN>2.9. ‘Intellectual Property’ means

                    all present and future copyright, registered and unregistered trademarks,

                    patent, design or rights and any other intellectual or industrial property

                    rights, discovery, invention, secret process or improvement in procedure of any

                    kind whether arising from statute, under common law or in equity.</span></h2>



            <h2><a name="_b770oih2lzu1"></a><span lang=EN>2.10. Related Entity has the same

                    meaning as in the Corporations Act 2001 (<span class=SpellE>Cth</span>).</span></h2>



            <p class=MsoNormal
                style='margin-top:8.55pt;margin-right:51.7pt;margin-bottom:

0in;margin-left:.5in;margin-bottom:.0001pt;line-height:118%;mso-pagination:

none'>
                <span lang=EN-AU
                    style='font-size:10.0pt;line-height:118%;mso-ascii-font-family:

Calibri;mso-fareast-font-family:Calibri;mso-hansi-font-family:Calibri;

mso-bidi-font-family:Calibri'>
                    <o:p>&nbsp;</o:p>
                </span>
            </p>



            <h1><a name="_gqye96f3vp97"></a><span lang=EN>3. CLASSIFICATION </span></h1>



            <h2><a name="_ekadxbpu4lrl"></a><span lang=EN>3.1. You shall report directly to

                    On My Way Therapy Australia PTY LTD </span></h2>



            <h2
                style='margin-top:5.95pt;margin-right:51.8pt;margin-bottom:0in;margin-left:

.5in;margin-bottom:.0001pt;text-indent:0in;line-height:118%;mso-pagination:

lines-together'>
                <a name="_i1z7uxc2wo16"></a><span lang=EN>3.2. You will

                    undertake the duties and exercise the powers of the position, at all times obey

                    the directions, policies and instructions of the Employer. </span>
            </h2>



            <h1 style='mso-pagination:lines-together'><a name="_jggux2wd32so"></a><span lang=EN>4. DUTY TO On My Way
                    Therapy Australia PTY LTD</span></h1>



            <h2><a name="_t7pgrg52vll"></a><span lang=EN>4.1. You shall faithfully oblige

                    the Employer, and use your best endeavors to promote its interests and welfare.

                </span></h2>



            <h2><a name="_b8q395bwlrk6"></a><span lang=EN>4.2. You shall devote the whole

                    of your time and attention during your working hours to your responsibilities

                    and duties and ensure you are performing solely <span class=GramE>work related</span>

                    activities in work time</span></h2>



            <h2><a name="_d02flscvmbxd"></a><span lang=EN>4.3. Rules designed to promote

                    and protect the health, safety and welfare of all employees may be made by the

                    Employer from time to time. You are required to comply with these rules. </span></h2>



            <h2><a name="_fo9mq210fx20"></a><span lang=EN>4.4. You agree that: </span></h2>



            <h3><a name="_k0mvissuifqh"></a><span lang=EN>4.4.1. You hold the

                    qualifications and have the skills as represented by you to the Employer.</span></h3>



            <h3><a name="_33c2ogeltl5k"></a><span lang=EN>4.4.2. You have disclosed to the

                    Employer any restraint or restriction which may affect your performance of

                    work.</span></h3>



            <h3><a name="_enzumndc66x4"></a><span lang=EN>4.4.3. You enter into this

                    contract without any form of coercion.</span></h3>



            <h3><a name="_6oppswj2322o"></a><span lang=EN>4.4.4. You are legally entitled

                    to work in Australia, and agree to produce the appropriate documentation where

                    requested by the Employer; and</span></h3>



            <h3><a name="_8ln6fxepxbuh"></a><span lang=EN>4.4.5. You have and will maintain

                    the licenses, professional registrations, and qualifications necessary to

                    fulfil your role.<span style='mso-spacerun:yes'>  </span></span></h3>



            <h2><a name="_3cq21vjtbiy5"></a><span lang=EN>4.5 ensure you are performing

                    solely <span class=GramE>work related</span> activities in work time</span></h2>



            <h2><a name="_j56hsvp9tc9c"></a><span lang=EN>4.6. You agree that at all times

                    faithfully, industriously, and to the best of his/her skill, ability,

                    experience and talents, perform all of the duties required in his/her position.

                    In carrying out these duties and responsibilities, the employee shall comply

                    with all On My Way Therapy Australia PTY LTD policies, procedures, rules and

                    regulations, both written and verbal, as are announced by On My Way Therapy

                    Australia PTY LTD from time to time. It is also understood and agreed to by the

                    employee that his/her assignment, duties and responsibilities and reporting

                    arrangements may be changed with On My Way Therapy Australia PTY LTD without

                    causing termination to this arrangement. </span></h2>



            <h2><a name="_pui16v35a4wn"></a><span lang=EN>4.7. As an employee you required

                    to perform the duties set out in his/her respective job as well as any other

                    duties as may arise from time to time (this includes reports, forms and other

                    paperwork related to the patient/client in question) and as may be assigned to

                    the employee by On My Way Therapy Australia PTY LTD.</span></h2>



            <h1><a name="_mk4tfinfp1ks"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h1>



            <h1><a name="_rvhycko7g00f"></a><span lang=EN>5. KEY RESPONSIBILITIES </span></h1>



            <h2><a name="_lcw32gata17v"></a><span lang=EN>5.1. A demonstrated ability to

                    assess, plan and <span class=GramE>implement,<span style='mso-spacerun:yes'>

                        </span>interventions</span> to achieve realistic, goal driven outcomes for

                    clients. </span></h2>



            <h2
                style='margin-top:11.7pt;margin-right:57.45pt;margin-bottom:0in;margin-left:

23.55pt;margin-bottom:.0001pt;line-height:99%;mso-pagination:lines-together'>
                <a name="_ozpdqnrbdxf0"></a><span lang=EN>5.2. Display excellent interpersonal and

                    communication skills to achieve identified client outcomes and maximize service

                    delivery. </span>
            </h2>



            <h2 style='margin-right:68.6pt;line-height:99%;mso-pagination:lines-together'><a name="_hw8sa1z4u4y4"></a><span
                    lang=EN>5.3. Ensure interventions provided are

                    in accordance with <span class=GramE>evidence based</span> practice, in a safe

                    and professional manner that meets the competency standards required by the

                    profession. </span></h2>



            <h2 style='margin-right:54.4pt;line-height:99%;mso-pagination:lines-together'><a name="_wc68252o9hrq"></a><span
                    lang=EN>5.4. There is an expectation that the

                    role will include direction to perform other duties that must be reasonable in

                    relation to the employee’s skills and abilities. </span></h2>



            <h2
                style='margin-top:.3pt;margin-right:59.85pt;margin-bottom:0in;margin-left:

23.55pt;margin-bottom:.0001pt;line-height:105%;mso-pagination:lines-together'>
                <a name="_c3hu2cqnwhx3"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span>
            </h2>



            <h2
                style='margin-top:.3pt;margin-right:59.85pt;margin-bottom:0in;margin-left:

23.55pt;margin-bottom:.0001pt;line-height:105%;mso-pagination:lines-together'>
                <a name="_9cskwihsynaf"></a><span lang=EN>5.6. Initial reports are required to be

                    completed within 2-4 sessions after initial assessment is complete </span>
            </h2>



            <h2
                style='margin-top:11.7pt;margin-right:66.1pt;margin-bottom:0in;margin-left:

23.55pt;margin-bottom:.0001pt;line-height:105%;mso-pagination:lines-together'>
                <a name="_g5ec6y136m4j"></a><span lang=EN>5.7. Service Agreements, <span class=SpellE>ndis</span> support
                    plan and risk <span class=GramE>assessment<span style='mso-spacerun:yes'>  </span>are</span> to be
                    completed and signed by the

                    participant and therapist prior to initial appointment to be conducted. </span>
            </h2>



            <h2
                style='margin-top:13.95pt;margin-right:68.9pt;margin-bottom:0in;margin-left:

23.55pt;margin-bottom:.0001pt;line-height:99%;mso-pagination:lines-together'>
                <a name="_evfmwxpjze92"></a><span lang=EN>5.8. A copy of the Service Agreement is

                    to be returned to On My Way Therapy Australia PTY LTD within 2 days of initial

                    assessment. Without the signed service <span class=GramE>agreement</span> the <span
                        class=SpellE>employee</span>/employee payment may be delayed as a result. </span>
            </h2>



            <h2><a name="_leuzgbwx3zdu"></a><span lang=EN>5.9. The following knowledge and

                    skills are required to be <span class=SpellE>utilised</span>: </span></h2>



            <h3 style='margin-top:12.3pt;line-height:normal;mso-pagination:lines-together'><a name="_6sl5tagin772"></a><span
                    lang=EN>5.9.1. Understand needs and requirements

                    of older people or young people with a disability </span></h3>



            <h3 style='margin-top:12.3pt;line-height:normal;mso-pagination:lines-together'><a
                    name="_j0czrrkd69xz"></a><span lang=EN>5.9.2. Understand complex requirements

                    of clients of all ages with neurological, musculoskeletal, cardiorespiratory

                    conditions and conditions affecting mood or cognition </span></h3>



            <h3
                style='margin-top:13.05pt;margin-right:57.05pt;margin-bottom:0in;

margin-left:1.0in;margin-bottom:.0001pt;line-height:99%;mso-pagination:lines-together'>
                <a name="_nze86gcdf16"></a><span lang=EN>5.9.3. Ability to assess, implement and

                    continuously evaluate treatment programs with respect to client goals </span>
            </h3>



            <h3 style='margin-top:13.05pt;line-height:normal;mso-pagination:lines-together'><a
                    name="_3dqjsi69xlc"></a><span lang=EN>5.9.4. To prescribe and assist in the use

                    of appropriate aids and equipment </span></h3>



            <h3 style='margin-top:12.3pt;line-height:normal;mso-pagination:lines-together'><a
                    name="_8bgtwhu9ve1n"></a><span lang=EN>5.9.5. To ensure safe and effective

                    handling of equipment and clients during therapy </span></h3>



            <h3 style='margin-top:25.1pt;line-height:normal;mso-pagination:lines-together'><a
                    name="_5xdm36vo04h9"></a><span lang=EN>5.9.6. Ensure clinical documentation

                    standards are met, and client statistics are recorded in a timely manner </span></h3>



            <h3
                style='margin-top:24.35pt;margin-right:73.15pt;margin-bottom:0in;

margin-left:1.0in;margin-bottom:.0001pt;line-height:99%;mso-pagination:lines-together'>
                <a name="_hpaw6gd4c7eb"></a><span lang=EN>5.9.7. Be involved in <span class=SpellE>organisational</span>
                    continuous improvement processes that

                    promote best practice and quality driven outcomes for clients </span>
            </h3>



            <h3 style='margin-top:24.35pt;line-height:normal;mso-pagination:lines-together'><a
                    name="_5jgd0fuod9uc"></a><span lang=EN>5.9.8. Communicate with individuals of

                    all <span class=GramE>ages ,</span> their <span class=SpellE>carers</span>,

                    family and relevant others. </span></h3>



            <h3
                style='margin-top:13.05pt;margin-right:53.5pt;margin-bottom:0in;margin-left:

1.0in;margin-bottom:.0001pt;line-height:99%;mso-pagination:lines-together'>
                <a name="_svg6pfex1ioh"></a><span lang=EN>5.9.9. Conduct work in line with all

                    relevant OH&amp;S legislation, and in accordance with <span class=SpellE>organisational</span>

                    policies and procedures. </span>
            </h3>



            <h3><a name="_jn4wpyiteac3"></a><span lang=EN>5.9.10. exhibit a professional

                    and courteous attitude when dealing with the Employer, its customers,

                    employees, suppliers and other members of the public; and</span></h3>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <h1><a name="_95o4auc9tfp6"></a><span lang=EN>6.<span style='mso-spacerun:yes'>  </span>THE USAGE OF
                    LETTERHEAD AND LOGO:</span></h1>



            <h2><a name="_e3mmbfys4orp"></a><span lang=EN>6.1. On My Way Therapy Australia

                    PTY LTD letterhead and logo must only be used when working for On My Way

                    Therapy Australia PTY LTD and not for any other external purposes. The employee

                    acknowledges the use of the letterhead and logo on all reports made. </span></h2>



            <h2><a name="_xuyaiawauhmu"></a><span lang=EN>6.2. The employee must not use

                    the letterhead or logo or assessment templates or report templates for personal

                    use or when representing any other entity.</span></h2>



            <h2><a name="_jut45m4qsdbb"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h2>



            <h1><a name="_402p1ktkgo64"></a><span lang=EN>7. REGISTRATION AND INSURANCE: </span></h1>



            <h2
                style='margin-top:13.05pt;margin-right:55.85pt;margin-bottom:0in;

margin-left:23.95pt;margin-bottom:.0001pt;text-indent:0in;line-height:115%;

mso-pagination:lines-together'>
                <a name="_w6wp7033xt1n"></a><span lang=EN>7.1.

                    Employee/contractor must maintain appropriate (valid and current) registration

                    with their relevant registration body and must maintain their own insurance

                    including public liability and professional indemnity cover during their

                    contract with the employer as advised by their registration body.</span>
            </h2>



            <h2
                style='margin-top:13.05pt;margin-right:55.85pt;margin-bottom:0in;

margin-left:23.95pt;margin-bottom:.0001pt;text-indent:0in;line-height:115%;

mso-pagination:lines-together'>
                <a name="_g0mhjohhcuxf"></a><span lang=EN>7.2.

                    Employees should provide their registration details or insurance details to

                    support Foundation in cases deemed by legislation, audit purposes or in the

                    case of complaint management process. </span>
            </h2>



            <h2><a name="_3pu0mmeh4ctj"></a><span lang=EN>7.3. You are required to provide

                    your own Public Liability and Professional Indemnity Insurance while working

                    for the Employer or as advised by their registration body.</span></h2>



            <h2><a name="_7bcj12muyl47"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h2>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <h1><a name="_okqrjj3v9eo2"></a><span lang=EN>8. HOURS OF WORK &amp; PERIOD OF

                    EMPLOYMENT </span></h1>



            <h2 style='margin-left:23.25pt;text-indent:0in'><a name="_onxngwbdbjsh"></a><span lang=EN>8.1. Your hours of
                    work will be based on contractor hours.</span></h2>



            <h2 style='margin-left:23.25pt;text-indent:0in'><a name="_sxsulmrrobar"></a><span lang=EN>8.2. Your hours of
                    work are those that are reasonably necessary to

                    fulfil the requirements of your role, or such hours as are required by the

                    Employer. <a name="_t7t1ovj2au08"></a><a name="_du5hlk77vu07"></a></span></h2>



            <h2 style='margin-left:23.25pt;text-indent:0in'><a name="_181pn330g06k"></a><a name="_3uay8v62nxw9"></a><span
                    lang=EN>8.5. Each party undertakes to give as

                    much notice as possible to the other party of their intention to seek a renewal

                    of the agreement. </span></h2>



            <h2 style='margin-left:23.25pt;text-indent:0in'><a name="_ytxf0s49bucn"></a><span lang=EN>8.6. Renewal or
                    termination on completion of this agreement will be at

                    the discretion of the Employer. </span></h2>



            <h1 style='margin-top:13.05pt;mso-pagination:lines-together'><a name="_ty6936ck390w"></a><span lang=EN>9.
                    PROBATION</span></h1>



            <h2 style='margin-left:23.25pt;text-indent:0in;line-height:normal;mso-pagination:

lines-together'><a
                    name="_m99h476mu3pk"></a><span lang=EN>9.1. Your employment

                    is probationary for the first six months of employment. </span></h2>



            <h2 style='margin-left:23.25pt;text-indent:0in;line-height:normal;mso-pagination:

lines-together'><a
                    name="_9qq9lcx3uyuz"></a><span lang=EN>9.2. The Employer

                    may, at its discretion, extend the probation period. </span></h2>



            <h2 style='margin-left:23.25pt;text-indent:0in;line-height:normal;mso-pagination:

lines-together'><a
                    name="_jyw7b2n9b64b"></a><span lang=EN>9.3. During the

                    probation period the employer may end your employment by providing 2 weeks’

                    notice <br>

                    <br style='mso-special-character:line-break'>

                    <![if !supportLineBreakNewLine]><br style='mso-special-character:line-break'>

                    <![endif]>
                </span></h2>



            <h1 style='margin-top:20.6pt;mso-pagination:lines-together'><a name="_jzj5zx6kxf38"></a><span lang=EN>10.
                    REMUNERATION </span></h1>



            <h2><a name="_8gi1r7ldj6uj"></a><span lang=EN>10.1. You will be paid the

                    previously mentioned amount </span></h2>



            <h2><a name="_jwq0xxvx5m01"></a><a name="_9xbmmse3wqq6"></a><span lang=EN>10.3.

                    Your payments will be paid fortnightly to your nominated financial institution.

                    Once an approved invoice is received and client payments are made.</span></h2>



            <h2><a name="_2yejn335z5bv"></a><span lang=EN>10.4. You will be paid $0.80 per

                    KM if traveling to clients periodically.</span></h2>



            <h2><a name="_aql6gerun1j8"></a><span lang=EN>10.5. Payments will be based on

                    actual hours worked and invoiced. Any billables must also be <span class=GramE>slotted<span
                            style='mso-spacerun:yes'>  </span>on</span> the calendar system for the

                    accounts team to match with invoice.</span></h2>



            <h2><a name="_kesj6u99slrc"></a><span lang=EN>Payments are made on the

                    fortnightly pay run Once an approved invoice is received and client payments

                    are made.</span></h2>



            <h2><a name="_967tr05l324t"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h2>



            <p class=MsoNormal
                style='margin-top:.3pt;margin-right:51.7pt;margin-bottom:

0in;margin-left:0in;margin-bottom:.0001pt;line-height:99%;mso-pagination:none'>
                <span lang=EN-AU
                    style='font-size:10.0pt;line-height:99%;mso-ascii-font-family:Calibri;

mso-fareast-font-family:Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:

Calibri'>
                    <o:p>&nbsp;</o:p>
                </span>
            </p>



            <h1><a name="_ddbnjfafvf1y"></a><span lang=EN>11.<span style='mso-spacerun:yes'>  </span>LEAVE</span></h1>



            <h2 style='text-indent:23.25pt'><a name="_ekuyiuwga30"></a><span lang=EN>11.1.

                    You must provide 4 weeks’ notice of your intention and the period for which you

                    wish to take leave.</span></h2>



            <h2
                style='margin-top:9.3pt;margin-right:71.75pt;margin-bottom:0in;margin-left:

0in;margin-bottom:.0001pt;text-align:justify;text-indent:0in;line-height:normal'>
                <span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span>
            </h2>



            <h1><a name="_midqnl3blki"></a><span lang=EN>12. TERMINATION OF EMPLOYMENT </span></h1>



            <h2 style='margin-left:0in;text-indent:0in'><a name="_epwabdduwwpu"></a><span lang=EN>12.1. Termination with
                    Notice</span></h2>



            <h2><a name="_irv3wzqi63sj"></a><span lang=EN>12.1.1. You are required to give

                    4 <span class=SpellE>weeks notice</span> if you wish to terminate this

                    contract. The 4 <span class=GramE>week</span> notice period is necessary to <span
                        class=SpellE>finalise</span> reports and handover notes to current clients and

                    for a new suitable replacement to commence.</span></h2>



            <h2><a name="_v7n3d1fxcs04"></a><span lang=EN>12.2.2. On termination of your

                    employment with the Employer you will be required to return any equipment and

                    any other items of property belonging to the Employer in your possession,

                    before your final payment is processed, as well as <span class=SpellE>finalise</span>

                    all reports and assessment overdue.</span></h2>



            <h2><a name="_thtoemozuje2"></a><span lang=EN>12.3.3. On termination of your

                    employment, the Employer may set off any amounts you owe the Employer against

                    the amounts that the Employer owes you at the date of termination except for

                    amounts the Employer is not entitled by law to set off.</span></h2>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <h2><a name="_enx2u3ike2m7"></a><span lang=EN>12.2. The Employer may terminate

                    your employment without notice or without a payment in lieu of notice for any of

                    the following reasons, if you: </span></h2>



            <h3><a name="_6hyjt2c69ann"></a><span lang=EN><span style='mso-spacerun:yes'> </span>12.2.1. commit any
                    serious or persistent

                    breach of any of the terms of the Contract;</span></h3>



            <h3 style='text-indent:1.0in'><a name="_7x76rponn3qx"></a><span lang=EN><span
                        style='mso-spacerun:yes'> </span>12.2.2. are guilty of dishonesty, misconduct

                    or neglect in the performance of your obligations under the Contract;</span></h3>



            <h3><a name="_r9ka6sorqijv"></a><span lang=EN>12.2.3. become insolvent or

                    bankrupt or make any assignment or arrangement with your creditors;</span></h3>



            <h3><a name="_oicfpst2jv38"></a><span lang=EN>12.2.4. are convicted of any

                    criminal offence relevant to the performance of your obligations under the

                    Contract;</span></h3>



            <h3><a name="_d6ufv14agxfn"></a><span lang=EN>12.2.5. refuse to comply with any

                    reasonable instruction or direction including any failure to comply with your

                    obligations under any of the Employer’s rules, policies and/or procedures and

                    any directions given by management of the Employer;</span></h3>



            <h3><a name="_xb4fo6ysx2p4"></a><span lang=EN>12.2.6. fail to perform to the

                    standard reasonably expected by the Employer, including persistent failure to

                    achieve targets;</span></h3>



            <h3><a name="_ct3zbxlqvibo"></a><span lang=EN>12.2.7. obtain a medical

                    assessment result that is not satisfactory to the Employer and which

                    objectively results in you being unable to perform your duties set out in the

                    Contract;</span></h3>



            <h3><a name="_66q1reen7rki"></a><span lang=EN>12.2.8. </span><span lang=EN
                    style='font-size:9.5pt;line-height:112%'>abuse alcohol or drugs whilst on the

                    Employer’s premises, or just prior to commencing work on the premises, which

                    adversely affects your ability to carry out your duties; or <o:p></o:p></span></h3>



            <h3><a name="_503a9lvc1q5k"></a><span lang=EN>12.2.9 engage in physical abuse

                    or display unreasonable verbal aggression.</span></h3>



            <h2 style='margin-left:0in;text-indent:0in'><a name="_nlahvxiriy9a"></a><a name="_7q6i0q6awd93"></a><span
                    lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h2>



            <h2><a name="_kaoo9m74dzw9"></a><span lang=EN>12.3. Examples of serious

                    misconduct include, but are not limited to: </span></h2>



            <h3
                style='margin-top:7.45pt;margin-right:51.55pt;margin-bottom:0in;margin-left:

1.5in;margin-bottom:.0001pt;text-indent:-.25in;line-height:normal;mso-pagination:

lines-together;mso-list:l1 level1 lfo3'>
                <a name="_z3sesxa9g8jc"></a>
                <![if !supportLists]><span lang=EN><span style='mso-list:Ignore'>●<span
                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN>Stealing </span>
            </h3>



            <h3
                style='margin-top:0in;margin-right:51.55pt;margin-bottom:0in;margin-left:

1.5in;margin-bottom:.0001pt;text-indent:-.25in;line-height:normal;mso-pagination:

lines-together;mso-list:l1 level1 lfo3'>
                <a name="_pyonh3zb71ii"></a>
                <![if !supportLists]><span lang=EN><span style='mso-list:Ignore'>●<span
                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN>Sexual

                    harassment </span>
            </h3>



            <h3
                style='margin-top:0in;margin-right:51.55pt;margin-bottom:0in;margin-left:

1.5in;margin-bottom:.0001pt;text-indent:-.25in;line-height:normal;mso-pagination:

lines-together;mso-list:l1 level1 lfo3'>
                <a name="_i5w0m7sh3sut"></a>
                <![if !supportLists]><span lang=EN><span style='mso-list:Ignore'>●<span
                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN>Violence </span>
            </h3>



            <h3
                style='margin-top:0in;margin-right:51.55pt;margin-bottom:0in;margin-left:

1.5in;margin-bottom:.0001pt;text-indent:-.25in;line-height:normal;mso-pagination:

lines-together;mso-list:l1 level1 lfo3'>
                <a name="_w75g8vy4bws6"></a>
                <![if !supportLists]><span lang=EN><span style='mso-list:Ignore'>●<span
                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN>Criminal

                    offences </span>
            </h3>



            <h3
                style='margin-top:0in;margin-right:51.55pt;margin-bottom:0in;margin-left:

1.5in;margin-bottom:.0001pt;text-indent:-.25in;line-height:normal;mso-pagination:

lines-together;mso-list:l1 level1 lfo3'>
                <a name="_2e5j2sx8ob5b"></a>
                <![if !supportLists]><span lang=EN><span style='mso-list:Ignore'>●<span
                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN>Breach of

                    trust or confidentiality </span>
            </h3>



            <h3
                style='margin-top:0in;margin-right:51.55pt;margin-bottom:0in;margin-left:

1.5in;margin-bottom:.0001pt;text-indent:-.25in;line-height:normal;mso-pagination:

lines-together;mso-list:l1 level1 lfo3'>
                <a name="_mqjwclnj3iiw"></a>
                <![if !supportLists]><span lang=EN><span style='mso-list:Ignore'>●<span
                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN>Breach of

                    safety procedures </span>
            </h3>



            <h2><a name="_88hhkz1cmijl"></a><span lang=EN>12.4. The specific detail of the

                    Employer’s policies <span class=GramE>do</span> not form a term of your

                    contract; and failure to comply with the Employer’s policies may result in

                    disciplinary action, up to and including dismissal.</span></h2>



            <h2><a name="_82cdh6fsrofl"></a><span lang=EN>12.5. Following completion of

                    your probationary period, at any time during the operation of the Contract, the

                    Employer may terminate your employment by providing written notice in

                    accordance with the table below or in accordance with the Industrial

                    Instrument, whichever is more <span class=SpellE><span class=GramE>favourable</span></span><span
                        class=GramE> :</span> </span></h2>



            <h2><a name="_aqm5f8ayxcpu"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h2>



            <h2><a name="_c1auhvlj4h1x"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h2>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <h2><a name="_g0mog7bcfscm"></a><span lang=EN>12.6. If you are over the age of

                    45 years and have at least two years' service, you are entitled to one

                    additional week’s notice of termination.</span></h2>



            <h2><a name="_hzp9x7gmfsba"></a><span lang=EN>12.7. The Employer may, at its

                    discretion, make payment to you in lieu of all or part of this notice period.

                    On termination, you are also entitled to payment for any untaken annual leave

                    entitlements.</span></h2>



            <h2><a name="_47hmi8tima6l"></a><span lang=EN>12.8. During the whole or any

                    part of the notice period, the Employer is under no obligation to assign you

                    duties or functions or to provide any work to you and may direct you not to

                    attend work during all or part of the notice period.</span></h2>



            <h2><a name="_xomnkwuuflmy"></a><span lang=EN>12.9. On termination of

                    employment for any reason, you must immediately return to the Employer all

                    property, documents and items relating to the business of the Employer which

                    you have in your possession or control. This includes, but is not limited to,

                    any car, equipment, papers, keys, reports, computers, information, programs,

                    records and documents, intellectual property and other information, in whatever

                    form, relating in any way to the Employer or its clients.</span></h2>



            <h2><a name="_cg2sa5h8hydn"></a><span lang=EN>12.10. On termination of

                    employment for any reason, you must also irretrievably delete any Confidential

                    Information stored on any computer, magnetic or optical disk or memory, and all

                    matter derived from those sources in your possession, custody, care or control

                    outside the Employer’s premises.</span></h2>



            <h2><a name="_fy7fdb4scu59"></a><span lang=EN>12.11. You will repay to the

                    Employer the balance of any loans or advances made by the Employer against your

                    pay or leave entitlements, or any money otherwise owed to the Employer by you.

                    The Employer is <span class=SpellE>authorised</span> to deduct from your final

                    pay any money owing to the Employer on termination.</span></h2>



            <p class=MsoNormal align=right
                style='margin-top:.15in;margin-right:88.0pt;

margin-bottom:0in;margin-left:0in;margin-bottom:.0001pt;text-align:right;

mso-pagination:none'>
                <span lang=EN-AU
                    style='font-size:10.0pt;mso-ascii-font-family:

Calibri;mso-fareast-font-family:Calibri;mso-hansi-font-family:Calibri;

mso-bidi-font-family:Calibri'>
                    <o:p>&nbsp;</o:p>
                </span>
            </p>



            <h1 style='margin-top:33.35pt;mso-pagination:lines-together'><a name="_qujauwd91140"></a><span lang=EN>13.
                    CONFIDENTIALITY </span></h1>



            <h2 style='margin-left:23.25pt;text-indent:0in'><a name="_dmmdo4no0x2k"></a><span lang=EN>13.1. You must
                    keep confidential all secrets and information which

                    becomes known to you in circumstances where you know or ought to have known

                    that the information is to be treated as confidential. This includes, but is

                    not limited to: </span></h2>



            <h3><a name="_syyviupn28ms"></a><span lang=EN>13.1.1. The Employer’s business

                    plans and forecasts;</span></h3>



            <h3><a name="_7iv8uekidx7e"></a><span lang=EN>13.1.2. The Employer’s financial

                    records, reports, accounts and proposals; </span></h3>



            <h3><a name="_ly7wmbknd9ln"></a><span lang=EN>13.1.3. The Employer’s materials,

                    manuals and staff training materials; </span></h3>



            <h3><a name="_4krq42bpf7hg"></a><span lang=EN>13.1.4. Client’s records; and </span></h3>



            <h3><a name="_3mlznagjmj5n"></a><span lang=EN>13.1.5. Client’s lists and names

                    of client contacts.</span></h3>



            <h2 style='text-indent:22.5pt'><a name="_rvowca91bpjq"></a><span lang=EN>13.2.

                    You are expressly forbidden from discussing sensitive information revealed by

                    clients with any person outside of the Employer. Sensitive client information

                    should only be discussed with other employees where absolutely necessary. </span></h2>



            <h2><a name="_3auczq4n5jom"></a><span lang=EN>13.3. Information or copies of

                    information must not be removed from our premises, except where your employment

                    requires it and where the Employer has given consent. </span></h2>



            <h2><a name="_a2a9iejxviig"></a><span lang=EN>13.4. Your obligation of confidentiality

                    exists both during your employment and after your employment ceases. </span></h2>



            <h2><a name="_vve5fer3mhx5"></a><span lang=EN>13.5. Any breach of

                    confidentiality by you shall be regarded by the Employer as serious misconduct

                    for which you may be dismissed without notice or payment of salary in lieu of

                    notice. </span></h2>



            <h2><a name="_5hif2x9tfm7o"></a><span lang=EN>13.6. On termination of your

                    employment, you shall return to the Employer all papers, records and documents

                    in your possession which relate in any way to the Employer. </span></h2>



            <p class=MsoNormal><a name="_fs9djg482eoi"></a><a name="_kd8n6zx4892e"></a><a name="_9x3v1ffm7tak"></a><a
                    name="_qy84z1heub6n"></a><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <p class=MsoNormal style='margin-top:5.95pt;mso-pagination:none'><a name="_c0r7e7gy11dd"></a><span lang=EN-AU
                    style='font-size:10.0pt;mso-ascii-font-family:

Calibri;mso-fareast-font-family:Calibri;mso-hansi-font-family:Calibri;

mso-bidi-font-family:Calibri'>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <h1><a name="_qrnqpjihzyb6"></a><a name="_dwzppas8jnze"></a><span lang=EN>16.

                    INTELLECTUAL PROPERTY AND MORAL RIGHTS </span></h1>



            <h2 style='margin-left:23.25pt;text-indent:0in'><a name="_bkmjz6wl10ka"></a><span lang=EN>16.1. You
                    acknowledge that all intellectual property (including all

                    copyright, patentable inventions, designs and trade marks) arising out of your

                    employment is owned by the Employer. </span></h2>



            <h2><a name="_jf3ze26fdszj"></a><span lang=EN>16.2. You consent, in relation to

                    all copyright material arising out of your employment (‘Material’), to the

                    extent permissible by law: </span></h2>



            <h3><a name="_n9kryk7keub3"></a><span lang=EN>16.2.1. To all acts and omissions

                    by the Employer or any related entity or licensee which would otherwise

                    infringe your moral or similar rights and to not assert any such moral or other

                    rights; and </span></h3>



            <h3><a name="_rfgmmk6sidvw"></a><span lang=EN>16.2.2. To the following acts and

                    omissions: </span></h3>



            <h4 style='text-indent:1.25in;mso-pagination:widow-orphan;mso-list:l2 level1 lfo2'><a
                    name="_ts2vsbx50blf"></a>
                <![if !supportLists]><span lang=EN><span style='mso-list:Ignore'>●<span
                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN>The failure

                    to attribute you as the author; </span>
            </h4>



            <h4 style='text-indent:1.25in;mso-pagination:widow-orphan;mso-list:l2 level1 lfo2'><a
                    name="_6pxuj41uf7vk"></a>
                <![if !supportLists]><span lang=EN><span style='mso-list:Ignore'>●<span
                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN>The

                    alteration of the Material in any matter authorized by the Employer; and</span>
            </h4>



            <h4 style='text-indent:1.25in;mso-pagination:widow-orphan;mso-list:l2 level1 lfo2'><a
                    name="_fxnc7rsukv0c"></a>
                <![if !supportLists]><span lang=EN><span style='mso-list:Ignore'>●<span
                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN>The use of

                    the Material other than as contemplated by this agreement. </span>
            </h4>



            <h4 style='text-indent:1.25in;mso-pagination:widow-orphan;mso-list:l2 level1 lfo2'><a
                    name="_aj49imprus8n"></a>
                <![if !supportLists]><span lang=EN><span style='mso-list:Ignore'>●<span
                            style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN>You agree

                    that Cross Care may use your image, name and title in marketing campaigns in

                    both digital and print during the time of your employment.</span>
            </h4>


            <h1 style='margin-top:8.55pt;mso-pagination:lines-together'><a name="_axoq43at23e8"></a><span lang=EN>17.
                    DUTY <span class=GramE>FOLLOWING<span style='mso-spacerun:yes'>  </span>TERMINATION</span> &amp;
                    during employment </span></h1>



            <h2
                style='margin-top:8.55pt;margin-right:71.75pt;margin-bottom:0in;margin-left:

22.5pt;margin-bottom:.0001pt;text-indent:0in;line-height:normal;mso-pagination:

lines-together'>
                <a name="_nsitbqrxz1pl"></a><span lang=EN>17.1. Except with the

                    prior written approval of the Employer, after the termination of your

                    employment, you shall not, for the Restraint Period: </span>
            </h2>



            <h3><a name="_86fd1sms2xb1"></a><span lang=EN>17.1.1. Directly or indirectly

                    approach, canvass solicit or endeavor to entice away from the Employer a client,

                    employee or business associate; including but not limited <span class=GramE>to,<span
                            style='mso-spacerun:yes'>  </span>therapists</span>, management staff or

                    administrative staff, referrers or contractors of any nature</span></h3>



            <h3><a name="_wqm7cdj7qr7u"></a><span lang=EN>17.1.2. Counsel, procure or

                    otherwise assist any person to do any of the acts referred to above. </span></h3>



            <h3><a name="_wl2lozgu4yae"></a><span lang=EN>17.1.3“Client” for the purpose of

                    this Clause means any person, employee, corporation or business who or which

                    were clients of the Employer in the period of 2 years prior to termination of

                    this agreement. </span></h3>



            <h3><a name="_dkg2lm1znsta"></a><span lang=EN>17.1.4. “Restraint Period” for

                    the purposes means a period of 2 years from the date of termination of this

                    agreement. </span></h3>



            <h2><a name="_qjhkc995lgvs"></a><span lang=EN>17.2. You acknowledge and agree

                    that the Restraint Period is reasonable to protect the Employer’s business

                    interests. </span></h2>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <h1
                style='margin-top:5.95pt;margin-right:0in;margin-bottom:11.0pt;margin-left:

28.35pt;text-align:justify;line-height:115%'>
                <a name="_4ks0kdx5nqv4"></a><span lang=EN style='font-variant:small-caps'>18. <span class=GramE>NON
                        SOLICITATION</span>

                    during employment AND </span><span lang=EN>POST-TERMINATION RESTRAINT</span>
            </h1>



            <h2><a name="_437v2cpvumub"></a><span lang=EN>18.1. From the date your

                    employment ends, you agree not to solicit or attempt to solicit business,

                    referrers, clients, employees, or <span class=GramE>contractors,<span style='mso-spacerun:yes'>
                        </span>from</span> any client for the duration of

                    the Restraint Period. </span></h2>



            <h2><a name="_3po2g5iu7mc0"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h2>



            <h2><a name="_5ira0kcsd9rq"></a><span lang=EN>18.2. From the date your

                    employment ends, you agree not to solicit, attempt to solicit, entice or

                    encourage any employee of the Client or the Employer to leave their engagement

                    with the Employer for the Restraint Period of 24 months. This included employee

                    or business associates; including but not limited <span class=GramE>to,<span style='mso-spacerun:yes'>
                        </span>therapists</span>, employees, contractors,

                    management staff, administrative staff, referrers or contractors of any nature.</span></h2>



            <h2><a name="_cnhprtzh8oq1"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h2>



            <h2><a name="_jvqn8e68tme"></a><span lang=EN>18.3. From the date your

                    employment ends, you agree not to interfere or attempt to interfere with the

                    relationship between the Employer and its Clients, employees or suppliers for

                    the duration of the Restraint Period. including but not limited <span class=GramE>to,<span
                            style='mso-spacerun:yes'>  </span>therapists</span>,

                    employees, contractors, management staff, administrative staff, referrers or

                    contractors of any nature.</span></h2>



            <h2><a name="_gjdgxs"></a><span lang=EN>18.4 In this provision:</span></h2>



            <h3 style='margin-bottom:11.0pt;text-align:justify;line-height:115%'><a name="_smwkgplw31t6"></a><span
                    lang=EN>18.5.1. Client means any person, firm or

                    company who at any time during the period of 12&nbsp;months prior to the

                    termination of your employment was a Client of the Employer in respect of the

                    part or parts of the business in which you were employed.</span></h3>



            <h2><a name="_i3gyrkbqnmky"></a><span lang=EN>18.5. Each of the covenants in

                    this clause will have effect as if it were the number of separate covenants

                    resulting from combining each covenant with each subsection of the defining

                    terms, referred to in the covenant. Each of the above obligations are separate

                    and independent obligations. In the event that one or more of the obligations

                    are found to be unenforceable, the remaining obligations will continue to

                    apply.</span></h2>



            <h2><a name="_17j7k6qoucbs"></a><span lang=EN>18.6. You acknowledge that each

                    of the above restrictions are reasonable and necessary to protect the

                    Employer’s legitimate interest.</span></h2>



            <h2><a name="_a271i0dqn8uq"></a><span lang=EN>18.7. You acknowledge that you

                    will be liable in damages (including punitive or special damages) arising out

                    of the breach of any of the terms of this provision.</span></h2>



            <p class=MsoNormal
                style='margin-top:6.8pt;margin-right:52.5pt;margin-bottom:

0in;margin-left:64.0pt;margin-bottom:.0001pt;text-indent:-21.65pt;line-height:

112%;mso-pagination:none'>
                <span lang=EN-AU
                    style='font-size:10.0pt;line-height:

112%;mso-ascii-font-family:Calibri;mso-fareast-font-family:Calibri;mso-hansi-font-family:

Calibri;mso-bidi-font-family:Calibri'>
                    <o:p>&nbsp;</o:p>
                </span>
            </p>



            <h1><a name="_u8qtmhfm6nsk"></a><span lang=EN>19. DISPUTE RESOLUTION </span></h1>



            <h2><a name="_2wqx3ocn4u22"></a><span lang=EN>19.1. In relation to any matter

                    that may be in dispute between the parties to this agreement (‘the matter’),

                    the parties: </span></h2>



            <h2><a name="_2rkpe8qwdian"></a><span lang=EN>19.2 Will attempt to resolve the

                    matter at the workplace level, including, but not limited to:</span></h2>



            <h3><a name="_23jluftf3lvd"></a><span lang=EN>19.2.1. The employee and his or

                    her supervisor meeting and conferring on the matter; and </span></h3>



            <h4
                style='margin-top:.95pt;margin-right:.75in;margin-bottom:0in;margin-left:

94.5pt;margin-bottom:.0001pt;line-height:118%;mso-pagination:lines-together'>
                <a name="_a0tz8jlz9h7w"></a><span lang=EN>19.2.1.<span class=GramE>1.If</span> the

                    matter is not resolved at such a meeting, the parties arranging further

                    discussions involving more senior levels of management (as appropriate); and </span>
            </h4>



            <h3><a name="_vse66ywmg71l"></a><span lang=EN>19.2.2. Acknowledge the right of

                    either party to appoint, in writing, another person to act on behalf of the

                    party in relation to resolving the matter at the workplace level; and </span></h3>



            <h3><a name="_mv5uua2ol00g"></a><span lang=EN>19.2.3. Agree to allow either

                    party to refer the matter to mediation if the matter cannot be resolved at the

                    workplace level; and </span></h3>



            <h3><a name="_os72j7ivet4s"></a><span lang=EN>19.2.4. Agree that if either

                    party refers the matter to mediation, both parties will participate in the

                    mediation process in good faith; and </span></h3>



            <h3 style='margin-right:51.75pt'><a name="_8bjyxou6mmxi"></a><span lang=EN>19.2.5.

                    Acknowledge the right of either party in relation to the mediation process; and

                </span></h3>



            <h3><a name="_jryi93dp765x"></a><span lang=EN>19.2.6. Agree that during the

                    time when the parties attempt to resolve the matter: </span></h3>



            <h4><a name="_vr66z7ps1u9z"></a><span lang=EN>19.2.6.<span class=GramE>1.The</span>

                    parties continue to work in accordance with this contract of employment unless

                    the employee has a reasonable concern about an imminent risk to his or her

                    health or safety; and </span></h4>



            <h4 style='line-height:115%'><a name="_4341qcug79ym"></a><span lang=EN>Subject

                    to relevant provisions of any State or Territory occupational health and safety

                    law, even if the employee has a reasonable concern about an imminent risk to

                    his or her health or safety, the employee must not unreasonably fail to comply

                    with a direction by the Employer to perform other available work, whether at

                    the</span></h4>



            <h4 style='line-height:115%'><a name="_2q030ym1zrxs"></a><span lang=EN>same

                    workplace or another workplace, that is safe and appropriate for the employee

                    to perform; and </span></h4>



            <h4 style='line-height:115%'><a name="_vnseytdbq9cw"></a><span lang=EN>19.2.6.2.

                    The parties must cooperate to ensure that the dispute resolution procedures are

                    carried out as quickly as is reasonably possible; and </span></h4>



            <h4 style='line-height:115%'><a name="_c1gaw06p0fq8"></a><span lang=EN>19.1.6.3.

                    Agree not to commence an action unless: </span></h4>



            <p class=MsoNormal
                style='margin-top:9.3pt;margin-right:50.95pt;margin-bottom:

0in;margin-left:2.0in;margin-bottom:.0001pt;text-indent:-.25in;line-height:

124%;mso-pagination:none;mso-list:l0 level1 lfo1'>
                <![if !supportLists]><span lang=EN-AU
                    style='font-size:10.0pt;line-height:124%;mso-ascii-font-family:Calibri;

mso-fareast-font-family:Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:

Calibri'><span
                        style='mso-list:Ignore'>●<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN-AU
                    style='font-size:10.0pt;line-height:124%;mso-ascii-font-family:Calibri;

mso-fareast-font-family:Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:

Calibri'>The
                    party initiating the action has genuinely attempted to resolve the

                    dispute at the workplace level; and <o:p></o:p></span>
            </p>



            <p class=MsoNormal style='margin-left:2.0in;text-indent:-.25in;mso-pagination:

none;mso-list:l0 level1 lfo1'>
                <![if !supportLists]><span lang=EN-AU
                    style='font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:

Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri'><span
                        style='mso-list:Ignore'>●<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN-AU
                    style='font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:

Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri'>Either;
                    <o:p></o:p>
                </span>
            </p>



            <p class=MsoNormal
                style='margin-top:0in;margin-right:50.8pt;margin-bottom:

0in;margin-left:2.0in;margin-bottom:.0001pt;text-indent:-.25in;line-height:

149%;mso-pagination:none;mso-list:l0 level1 lfo1'>
                <![if !supportLists]><span lang=EN-AU
                    style='font-size:10.0pt;line-height:149%;mso-ascii-font-family:Calibri;

mso-fareast-font-family:Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:

Calibri'><span
                        style='mso-list:Ignore'>●<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN-AU
                    style='font-size:10.0pt;line-height:149%;mso-ascii-font-family:Calibri;

mso-fareast-font-family:Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:

Calibri'>A
                    period of 7 days has expired from the date when the party initiating

                    the action gave notice that mediation is not requested; or <o:p></o:p></span>
            </p>



            <p class=MsoNormal
                style='margin-top:0in;margin-right:54.05pt;margin-bottom:

0in;margin-left:2.0in;margin-bottom:.0001pt;text-indent:-.25in;mso-pagination:

none;mso-list:l0 level1 lfo1'>
                <![if !supportLists]><span lang=EN-AU
                    style='font-size:10.0pt;mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'><span
                        style='mso-list:Ignore'>●<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </span></span></span>
                <![endif]><span dir=LTR></span><span lang=EN-AU style='font-size:10.0pt'><span
                        style='mso-spacerun:yes'> </span></span><span lang=EN-AU
                    style='font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:

Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri'>The

                    mediation was requested by either party and that mediation has been completed.</span><span lang=EN-AU
                    style='font-size:10.0pt'>
                    <o:p></o:p>
                </span>
            </p>



            <p class=MsoNormal
                style='margin-top:8.05pt;margin-right:54.05pt;margin-bottom:

0in;margin-left:0in;margin-bottom:.0001pt;mso-pagination:none'>
                <span lang=EN-AU
                    style='font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:

Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri'>
                    <o:p>&nbsp;</o:p>
                </span>
            </p>



            <h1 style='margin-top:6.25pt'><span lang=EN>20. National Police check</span></h1>



            <h2><span lang=EN>20.1. You may be required to undergo a National Police Check.</span></h2>



            <h2><span lang=EN>20.2 If you do not pass a National Police Check and having a

                    National Police Check is considered an inherent requirement of your position,

                    it may result in the termination of your employment.</span></h2>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <h1><span lang=EN>21. Working with Children Check</span></h1>



            <h2><span lang=EN>21.1. The Employee shall maintain at their own expense at all

                    times a current and valid WWCC Screening check if the Employee is working with

                    children.</span></h2>



            <h2><span lang=EN>21.2. If you do not pass a WWCC and having a WWCC is

                    considered an inherent requirement of your position, it may result in the

                    termination of your employment. </span></h2>



            <p class=MsoNormal><span lang=EN style='mso-ansi-language:EN;mso-fareast-language:

EN-GB'>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <p class=MsoNormal><span lang=EN style='mso-ansi-language:EN;mso-fareast-language:

EN-GB'>You will also be
                    required to have an NDIS workers screening check <o:p></o:p></span></p>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <h1
                style='margin-top:5.95pt;margin-right:0in;margin-bottom:11.0pt;margin-left:

28.35pt;text-align:justify;line-height:115%'>
                <a name="_wo4sime1zn6d"></a><span lang=EN>22. REDUNDANCY</span>
            </h1>



            <h2 style='line-height:115%'><a name="_c7cr2osrvwki"></a><span lang=EN>22.<span class=GramE>1.If</span> your
                    position is made redundant, you shall not be

                    entitled to any payment except as required under the Fair Work Act.</span></h2>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <h1 style='line-height:115%'><a name="_1m7ad1xh0ynk"></a><span lang=EN>23.

                    ASSIGNMENT</span></h1>



            <h2 style='margin-bottom:11.0pt;text-align:justify;line-height:115%'><a name="_1d4a3w53wa9"></a><span
                    lang=EN>23.1. You may not assign or transfer the

                    rights and benefits under this contract. </span></h2>



            <h2 style='margin-bottom:11.0pt;text-align:justify;line-height:115%'><a name="_gmdljza0yu2b"></a><span
                    lang=EN>23.2. The Employer may assign its rights

                    and obligations under the Contract to any person, business, company or entity.</span></h2>



            <h1
                style='margin-top:5.95pt;margin-right:0in;margin-bottom:11.0pt;margin-left:

28.35pt;text-align:justify;line-height:115%'>
                <a name="_rm8rrn3nfpns"></a><span lang=EN>24. GOVERNING LAW</span>
            </h1>



            <h2
                style='margin-top:13.05pt;margin-right:71.75pt;margin-bottom:11.0pt;

margin-left:28.35pt;text-align:justify;text-indent:0in;line-height:115%'>
                <a name="_5k9tjjj0ybuc"></a><span lang=EN>24.1. The Contract shall be governed by

                    the jurisdiction of the courts in the State or Territory as described at<b
                        style='mso-bidi-font-weight:normal'> Item&nbsp;10 </b>of the Schedule.<b
                        style='mso-bidi-font-weight:normal'> </b></span>
            </h2>



            <h1
                style='margin-top:5.95pt;margin-right:0in;margin-bottom:11.0pt;margin-left:

28.35pt;text-align:justify;line-height:115%'>
                <a name="_gynx5wm8b2lq"></a><span lang=EN>25. VARIATION OF TERMS</span>
            </h1>



            <h2
                style='margin-top:13.05pt;margin-right:71.75pt;margin-bottom:11.0pt;

margin-left:28.35pt;text-align:justify;text-indent:0in;line-height:115%'>
                <a name="_8203lpsyx6ie"></a><span lang=EN>25.1. The terms of the Contract may be

                    varied from time to time by mutual agreement in writing between the parties.</span>
            </h2>



            <h1
                style='margin-top:5.95pt;margin-right:0in;margin-bottom:11.0pt;margin-left:

28.35pt;text-align:justify;line-height:115%'>
                <a name="_gkkwz3yaab18"></a><span lang=EN>26. SEVERABILITY</span>
            </h1>



            <h2
                style='margin-top:13.05pt;margin-right:71.75pt;margin-bottom:11.0pt;

margin-left:28.35pt;text-align:justify;text-indent:0in;line-height:115%'>
                <a name="_vx8kkfnuisz7"></a><span lang=EN>26.1. If any of the terms and conditions

                    of the Contract are void, or become voidable by reason of any statute or rule

                    of law then that term or condition shall be severed from the Contract without

                    affecting the enforceability of the remaining terms and conditions.</span>
            </h2>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



            <h1
                style='margin-top:5.95pt;margin-right:0in;margin-bottom:11.0pt;margin-left:

28.35pt;text-align:justify;line-height:115%'>
                <a name="_5dd30llhho3z"></a><span lang=EN>27. ENTIRE AGREEMENT</span>
            </h1>



            <h2
                style='margin-top:13.05pt;margin-right:71.75pt;margin-bottom:11.0pt;

margin-left:28.35pt;text-align:justify;text-indent:0in;line-height:115%'>
                <a name="_3e2l9vqr794q"></a><span lang=EN>27.1. The contents of the Contract

                    constitute the entire agreement between you and the Employer. Any previous

                    agreements, understandings, and negotiations on this subject matter cease to

                    have effect.</span>
            </h2>



            <p class=MsoNormal
                style='margin-top:8.05pt;margin-right:54.05pt;margin-bottom:

0in;margin-left:0in;margin-bottom:.0001pt;mso-pagination:none'>
                <span lang=EN-AU
                    style='font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:

Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri'>
                    <o:p>&nbsp;</o:p>
                </span>
            </p>



            <h1><a name="_wzvgb8sqp1yj"></a><span lang=EN>28. ACCEPTANCE OF OFFER </span></h1>



            <h2><a name="_r4mcwnkvygrk"></a><span lang=EN>28.1. Should you consider that

                    this document does not accurately state the terms and conditions of your

                    employment, please discuss those terms with the employee before you sign this

                    letter. If you have any questions concerning the position or any of the terms

                    of this letter, please contact the Employer. </span></h2>



            <h2><a name="_o1ntx3895tsr"></a><span lang=EN>28.2. Otherwise, please sign the

                    duplicate of this document and initial each page as evidence that you agree

                    that it accurately sets out the terms and conditions of your employment. The

                    signed document must be returned to the Employer. </span></h2>



            <h2><a name="_76ksbun09qyg"></a><span lang=EN>
                    <o:p>&nbsp;</o:p>
                </span></h2>



            <p class=MsoNormal style='mso-pagination:none'><b style='mso-bidi-font-weight:

normal'><span lang=EN-AU
                        style='font-size:10.0pt;mso-ascii-font-family:Calibri;

mso-fareast-font-family:Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:

Calibri'>29.
                        ACCEPTANCE OF OFFER <o:p></o:p></span></b></p>



            <p class=MsoNormal
                style='margin-top:49.1pt;margin-right:53.45pt;margin-bottom:

0in;margin-left:22.5pt;margin-bottom:.0001pt;line-height:118%;mso-pagination:

none'>
                <span lang=EN-AU
                    style='font-size:10.0pt;line-height:118%;mso-ascii-font-family:

Calibri;mso-fareast-font-family:Calibri;mso-hansi-font-family:Calibri;

mso-bidi-font-family:Calibri'>I
                    have read the terms and conditions contained in

                    this offer and accept the offer of the position and the terms and conditions

                    set out in this document. <o:p></o:p></span>
            </p>



            <p class=MsoNormal
                style='margin-top:46.45pt;margin-right:0in;margin-bottom:

0in;margin-left:22.5pt;margin-bottom:.0001pt;mso-pagination:none'>
                <span lang=EN-AU
                    style='font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:

Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri'>SIGNED
                    by<o:p></o:p></span>
            </p>



            <p class=MsoNormal
                style='margin-top:46.45pt;margin-right:0in;margin-bottom:

0in;margin-left:22.5pt;margin-bottom:.0001pt;mso-pagination:none'>
                <span lang=EN-AU
                    style='font-size:10.0pt;mso-ascii-font-family:Calibri;mso-fareast-font-family:

Calibri;mso-hansi-font-family:Calibri;mso-bidi-font-family:Calibri'>(Date)
                    <o:p></o:p>
                </span>
            </p>



            <p class=MsoNormal><span lang=EN-AU>
                    <o:p>&nbsp;</o:p>
                </span></p>



        </div>



    </body>



    </html>


@endsection
