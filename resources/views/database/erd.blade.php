<!DOCTYPE html>
<html lang='en-us' xmlns='http://www.w3.org/1999/xhtml'>

<head>
    <title>Medlink&#45;database</title>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
    <link rel='shortcut icon' href='https://dbschema.com/img/favicons/favicon.ico'>
    <style>
        @charset "UTF-8";

        /*!
 * Bootstrap  v5.3.0 (https://getbootstrap.com/)
 * Copyright 2011-2023 The Bootstrap Authors
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 */
        :root,
        [data-bs-theme=light] {
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-black: #000;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-gray-100: #f8f9fa;
            --bs-gray-200: #e9ecef;
            --bs-gray-300: #dee2e6;
            --bs-gray-400: #ced4da;
            --bs-gray-500: #adb5bd;
            --bs-gray-600: #6c757d;
            --bs-gray-700: #495057;
            --bs-gray-800: #343a40;
            --bs-gray-900: #212529;
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-primary-rgb: 13, 110, 253;
            --bs-secondary-rgb: 108, 117, 125;
            --bs-success-rgb: 25, 135, 84;
            --bs-info-rgb: 13, 202, 240;
            --bs-warning-rgb: 255, 193, 7;
            --bs-danger-rgb: 220, 53, 69;
            --bs-light-rgb: 248, 249, 250;
            --bs-dark-rgb: 33, 37, 41;
            --bs-primary-text-emphasis: #052c65;
            --bs-secondary-text-emphasis: #2b2f32;
            --bs-success-text-emphasis: #0a3622;
            --bs-info-text-emphasis: #055160;
            --bs-warning-text-emphasis: #664d03;
            --bs-danger-text-emphasis: #58151c;
            --bs-light-text-emphasis: #495057;
            --bs-dark-text-emphasis: #495057;
            --bs-primary-bg-subtle: #cfe2ff;
            --bs-secondary-bg-subtle: #e2e3e5;
            --bs-success-bg-subtle: #d1e7dd;
            --bs-info-bg-subtle: #cff4fc;
            --bs-warning-bg-subtle: #fff3cd;
            --bs-danger-bg-subtle: #f8d7da;
            --bs-light-bg-subtle: #fcfcfd;
            --bs-dark-bg-subtle: #ced4da;
            --bs-primary-border-subtle: #9ec5fe;
            --bs-secondary-border-subtle: #c4c8cb;
            --bs-success-border-subtle: #a3cfbb;
            --bs-info-border-subtle: #9eeaf9;
            --bs-warning-border-subtle: #ffe69c;
            --bs-danger-border-subtle: #f1aeb5;
            --bs-light-border-subtle: #e9ecef;
            --bs-dark-border-subtle: #adb5bd;
            --bs-white-rgb: 255, 255, 255;
            --bs-black-rgb: 0, 0, 0;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            --bs-body-font-family: var(--bs-font-sans-serif);
            --bs-body-font-size: 1rem;
            --bs-body-font-weight: 400;
            --bs-body-line-height: 1.5;
            --bs-body-color: #212529;
            --bs-body-color-rgb: 33, 37, 41;
            --bs-body-bg: #fff;
            --bs-body-bg-rgb: 255, 255, 255;
            --bs-emphasis-color: #000;
            --bs-emphasis-color-rgb: 0, 0, 0;
            --bs-secondary-color: rgba(33, 37, 41, 0.75);
            --bs-secondary-color-rgb: 33, 37, 41;
            --bs-secondary-bg: #e9ecef;
            --bs-secondary-bg-rgb: 233, 236, 239;
            --bs-tertiary-color: rgba(33, 37, 41, 0.5);
            --bs-tertiary-color-rgb: 33, 37, 41;
            --bs-tertiary-bg: #f8f9fa;
            --bs-tertiary-bg-rgb: 248, 249, 250;
            --bs-heading-color: inherit;
            --bs-link-color: #0d6efd;
            --bs-link-color-rgb: 13, 110, 253;
            --bs-link-decoration: underline;
            --bs-link-hover-color: #0a58ca;
            --bs-link-hover-color-rgb: 10, 88, 202;
            --bs-code-color: #d63384;
            --bs-highlight-bg: #fff3cd;
            --bs-border-width: 1px;
            --bs-border-style: solid;
            --bs-border-color: #dee2e6;
            --bs-border-color-translucent: rgba(0, 0, 0, 0.175);
            --bs-border-radius: 0.375rem;
            --bs-border-radius-sm: 0.25rem;
            --bs-border-radius-lg: 0.5rem;
            --bs-border-radius-xl: 1rem;
            --bs-border-radius-xxl: 2rem;
            --bs-border-radius-2xl: var(--bs-border-radius-xxl);
            --bs-border-radius-pill: 50rem;
            --bs-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            --bs-box-shadow-sm: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --bs-box-shadow-lg: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            --bs-box-shadow-inset: inset 0 1px 2px rgba(0, 0, 0, 0.075);
            --bs-focus-ring-width: 0.25rem;
            --bs-focus-ring-opacity: 0.25;
            --bs-focus-ring-color: rgba(13, 110, 253, 0.25);
            --bs-form-valid-color: #198754;
            --bs-form-valid-border-color: #198754;
            --bs-form-invalid-color: #dc3545;
            --bs-form-invalid-border-color: #dc3545
        }

        [data-bs-theme=dark] {
            color-scheme: dark;
            --bs-body-color: #adb5bd;
            --bs-body-color-rgb: 173, 181, 189;
            --bs-body-bg: #37383c;
            --bs-body-bg-rgb: 33, 37, 41;
            --bs-emphasis-color: #fff;
            --bs-emphasis-color-rgb: 255, 255, 255;
            --bs-secondary-color: rgba(173, 181, 189, 0.75);
            --bs-secondary-color-rgb: 173, 181, 189;
            --bs-secondary-bg: #343a40;
            --bs-secondary-bg-rgb: 52, 58, 64;
            --bs-tertiary-color: rgba(173, 181, 189, 0.5);
            --bs-tertiary-color-rgb: 173, 181, 189;
            --bs-tertiary-bg: #2b3035;
            --bs-tertiary-bg-rgb: 43, 48, 53;
            --bs-primary-text-emphasis: #6ea8fe;
            --bs-secondary-text-emphasis: #a7acb1;
            --bs-success-text-emphasis: #75b798;
            --bs-info-text-emphasis: #6edff6;
            --bs-warning-text-emphasis: #ffda6a;
            --bs-danger-text-emphasis: #ea868f;
            --bs-light-text-emphasis: #f8f9fa;
            --bs-dark-text-emphasis: #dee2e6;
            --bs-primary-bg-subtle: #031633;
            --bs-secondary-bg-subtle: #161719;
            --bs-success-bg-subtle: #051b11;
            --bs-info-bg-subtle: #032830;
            --bs-warning-bg-subtle: #332701;
            --bs-danger-bg-subtle: #2c0b0e;
            --bs-light-bg-subtle: #343a40;
            --bs-dark-bg-subtle: #1a1d20;
            --bs-primary-border-subtle: #084298;
            --bs-secondary-border-subtle: #41464b;
            --bs-success-border-subtle: #0f5132;
            --bs-info-border-subtle: #087990;
            --bs-warning-border-subtle: #997404;
            --bs-danger-border-subtle: #842029;
            --bs-light-border-subtle: #495057;
            --bs-dark-border-subtle: #343a40;
            --bs-heading-color: inherit;
            --bs-link-color: #6ea8fe;
            --bs-link-hover-color: #8bb9fe;
            --bs-link-color-rgb: 110, 168, 254;
            --bs-link-hover-color-rgb: 139, 185, 254;
            --bs-code-color: #e685b5;
            --bs-border-color: #495057;
            --bs-border-color-translucent: rgba(255, 255, 255, 0.15);
            --bs-form-valid-color: #75b798;
            --bs-form-valid-border-color: #75b798;
            --bs-form-invalid-color: #ea868f;
            --bs-form-invalid-border-color: #ea868f
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box
        }

        @media (prefers-reduced-motion:no-preference) {
            :root {
                scroll-behavior: smooth
            }
        }

        body {
            margin: 0;
            font-family: var(--bs-body-font-family);
            font-size: var(--bs-body-font-size);
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            color: var(--bs-body-color);
            text-align: var(--bs-body-text-align);
            background-color: var(--bs-body-bg);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent
        }

        hr {
            margin: 1rem 0;
            color: inherit;
            border: 0;
            border-top: var(--bs-border-width) solid;
            opacity: .25
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2;
            color: var(--bs-heading-color)
        }

        .h1,
        h1 {
            font-size: calc(1.375rem + 1.5vw)
        }

        @media (min-width:1200px) {

            .h1,
            h1 {
                font-size: 2.5rem
            }
        }

        .h2,
        h2 {
            font-size: calc(1.325rem + .9vw)
        }

        @media (min-width:1200px) {

            .h2,
            h2 {
                font-size: 2rem
            }
        }

        .h3,
        h3 {
            font-size: calc(1.3rem + .6vw)
        }

        @media (min-width:1200px) {

            .h3,
            h3 {
                font-size: 1.75rem
            }
        }

        .h4,
        h4 {
            font-size: calc(1.275rem + .3vw)
        }

        @media (min-width:1200px) {

            .h4,
            h4 {
                font-size: 1.5rem
            }
        }

        .h5,
        h5 {
            font-size: 1.25rem
        }

        .h6,
        h6 {
            font-size: 1rem
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        abbr[title] {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted;
            cursor: help;
            -webkit-text-decoration-skip-ink: none;
            text-decoration-skip-ink: none
        }

        address {
            margin-bottom: 1rem;
            font-style: normal;
            line-height: inherit
        }

        ol,
        ul {
            padding-left: 2rem
        }

        dl,
        ol,
        ul {
            margin-top: 0;
            margin-bottom: 1rem
        }

        ol ol,
        ol ul,
        ul ol,
        ul ul {
            margin-bottom: 0
        }

        dt {
            font-weight: 700
        }

        dd {
            margin-bottom: .5rem;
            margin-left: 0
        }

        blockquote {
            margin: 0 0 1rem
        }

        b,
        strong {
            font-weight: bolder
        }

        .small,
        small {
            font-size: .875em
        }

        .mark,
        mark {
            padding: .1875em;
            background-color: var(--bs-highlight-bg)
        }

        sub,
        sup {
            position: relative;
            font-size: .75em;
            line-height: 0;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        a {
            color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1));
            text-decoration: underline
        }

        a:hover {
            --bs-link-color-rgb: var(--bs-link-hover-color-rgb)
        }

        a:not([href]):not([class]),
        a:not([href]):not([class]):hover {
            color: inherit;
            text-decoration: none
        }

        code,
        kbd,
        pre,
        samp {
            font-family: var(--bs-font-monospace);
            font-size: 1em
        }

        pre {
            display: block;
            margin-top: 0;
            margin-bottom: 1rem;
            overflow: auto;
            font-size: .875em
        }

        pre code {
            font-size: inherit;
            color: inherit;
            word-break: normal
        }

        code {
            font-size: .875em;
            color: var(--bs-code-color);
            word-wrap: break-word
        }

        a>code {
            color: inherit
        }

        kbd {
            padding: .1875rem .375rem;
            font-size: .875em;
            color: var(--bs-body-bg);
            background-color: var(--bs-body-color);
            border-radius: .25rem
        }

        kbd kbd {
            padding: 0;
            font-size: 1em
        }

        figure {
            margin: 0 0 1rem
        }

        img,
        svg {
            vertical-align: middle
        }

        table {
            caption-side: bottom;
            border-collapse: collapse
        }

        caption {
            padding-top: .5rem;
            padding-bottom: .5rem;
            color: var(--bs-secondary-color);
            text-align: left
        }

        th {
            text-align: inherit;
            text-align: -webkit-match-parent
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0
        }

        label {
            display: inline-block
        }

        button {
            border-radius: 0
        }

        button:focus:not(:focus-visible) {
            outline: 0
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit
        }

        button,
        select {
            text-transform: none
        }

        [role=button] {
            cursor: pointer
        }

        select {
            word-wrap: normal
        }

        select:disabled {
            opacity: 1
        }

        [list]:not([type=date]):not([type=datetime-local]):not([type=month]):not([type=week]):not([type=time])::-webkit-calendar-picker-indicator {
            display: none !important
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button
        }

        [type=button]:not(:disabled),
        [type=reset]:not(:disabled),
        [type=submit]:not(:disabled),
        button:not(:disabled) {
            cursor: pointer
        }

        ::-moz-focus-inner {
            padding: 0;
            border-style: none
        }

        textarea {
            resize: vertical
        }

        fieldset {
            min-width: 0;
            padding: 0;
            margin: 0;
            border: 0
        }

        legend {
            float: left;
            width: 100%;
            padding: 0;
            margin-bottom: .5rem;
            font-size: calc(1.275rem + .3vw);
            line-height: inherit
        }

        @media (min-width:1200px) {
            legend {
                font-size: 1.5rem
            }
        }

        legend+* {
            clear: left
        }

        ::-webkit-datetime-edit-day-field,
        ::-webkit-datetime-edit-fields-wrapper,
        ::-webkit-datetime-edit-hour-field,
        ::-webkit-datetime-edit-minute,
        ::-webkit-datetime-edit-month-field,
        ::-webkit-datetime-edit-text,
        ::-webkit-datetime-edit-year-field {
            padding: 0
        }

        ::-webkit-inner-spin-button {
            height: auto
        }

        [type=search] {
            outline-offset: -2px;
            -webkit-appearance: textfield
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-color-swatch-wrapper {
            padding: 0
        }

        ::-webkit-file-upload-button {
            font: inherit;
            -webkit-appearance: button
        }

        ::file-selector-button {
            font: inherit;
            -webkit-appearance: button
        }

        output {
            display: inline-block
        }

        iframe {
            border: 0
        }

        summary {
            display: list-item;
            cursor: pointer
        }

        progress {
            vertical-align: baseline
        }

        [hidden] {
            display: none !important
        }

        .lead {
            font-size: 1.25rem;
            font-weight: 300
        }

        .display-1 {
            font-size: calc(1.625rem + 4.5vw);
            font-weight: 300;
            line-height: 1.2
        }

        @media (min-width:1200px) {
            .display-1 {
                font-size: 5rem
            }
        }

        .display-2 {
            font-size: calc(1.575rem + 3.9vw);
            font-weight: 300;
            line-height: 1.2
        }

        @media (min-width:1200px) {
            .display-2 {
                font-size: 4.5rem
            }
        }

        .display-3 {
            font-size: calc(1.525rem + 3.3vw);
            font-weight: 300;
            line-height: 1.2
        }

        @media (min-width:1200px) {
            .display-3 {
                font-size: 4rem
            }
        }

        .display-4 {
            font-size: calc(1.475rem + 2.7vw);
            font-weight: 300;
            line-height: 1.2
        }

        @media (min-width:1200px) {
            .display-4 {
                font-size: 3.5rem
            }
        }

        .display-5 {
            font-size: calc(1.425rem + 2.1vw);
            font-weight: 300;
            line-height: 1.2
        }

        @media (min-width:1200px) {
            .display-5 {
                font-size: 3rem
            }
        }

        .display-6 {
            font-size: calc(1.375rem + 1.5vw);
            font-weight: 300;
            line-height: 1.2
        }

        @media (min-width:1200px) {
            .display-6 {
                font-size: 2.5rem
            }
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none
        }

        .list-inline {
            padding-left: 0;
            list-style: none
        }

        .list-inline-item {
            display: inline-block
        }

        .list-inline-item:not(:last-child) {
            margin-right: .5rem
        }

        .initialism {
            font-size: .875em;
            text-transform: uppercase
        }

        .blockquote {
            margin-bottom: 1rem;
            font-size: 1.25rem
        }

        .blockquote>:last-child {
            margin-bottom: 0
        }

        .blockquote-footer {
            margin-top: -1rem;
            margin-bottom: 1rem;
            font-size: .875em;
            color: #6c757d
        }

        .blockquote-footer::before {
            content: "— "
        }

        .img-fluid {
            max-width: 100%;
            height: auto
        }

        .img-thumbnail {
            padding: .25rem;
            background-color: var(--bs-body-bg);
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            max-width: 100%;
            height: auto
        }

        .figure {
            display: inline-block
        }

        .figure-img {
            margin-bottom: .5rem;
            line-height: 1
        }

        .figure-caption {
            font-size: .875em;
            color: var(--bs-secondary-color)
        }

        .container,
        .container-fluid,
        .container-lg,
        .container-md,
        .container-sm,
        .container-xl,
        .container-xxl {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            width: 100%;
            padding-right: calc(var(--bs-gutter-x) * .5);
            padding-left: calc(var(--bs-gutter-x) * .5);
            margin-right: auto;
            margin-left: auto
        }

        @media (min-width:576px) {

            .container,
            .container-sm {
                max-width: 540px
            }
        }

        @media (min-width:768px) {

            .container,
            .container-md,
            .container-sm {
                max-width: 720px
            }
        }

        @media (min-width:992px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm {
                max-width: 960px
            }
        }

        @media (min-width:1200px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                max-width: 1140px
            }
        }

        @media (min-width:1400px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl,
            .container-xxl {
                max-width: 1320px
            }
        }

        :root {
            --bs-breakpoint-xs: 0;
            --bs-breakpoint-sm: 576px;
            --bs-breakpoint-md: 768px;
            --bs-breakpoint-lg: 992px;
            --bs-breakpoint-xl: 1200px;
            --bs-breakpoint-xxl: 1400px
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-.5 * var(--bs-gutter-x));
            margin-left: calc(-.5 * var(--bs-gutter-x))
        }

        .row>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) * .5);
            padding-left: calc(var(--bs-gutter-x) * .5);
            margin-top: var(--bs-gutter-y)
        }

        .col {
            flex: 1 0 0%
        }

        .row-cols-auto>* {
            flex: 0 0 auto;
            width: auto
        }

        .row-cols-1>* {
            flex: 0 0 auto;
            width: 100%
        }

        .row-cols-2>* {
            flex: 0 0 auto;
            width: 50%
        }

        .row-cols-3>* {
            flex: 0 0 auto;
            width: 33.3333333333%
        }

        .row-cols-4>* {
            flex: 0 0 auto;
            width: 25%
        }

        .row-cols-5>* {
            flex: 0 0 auto;
            width: 20%
        }

        .row-cols-6>* {
            flex: 0 0 auto;
            width: 16.6666666667%
        }

        .col-auto {
            flex: 0 0 auto;
            width: auto
        }

        .col-1 {
            flex: 0 0 auto;
            width: 8.33333333%
        }

        .col-2 {
            flex: 0 0 auto;
            width: 16.66666667%
        }

        .col-3 {
            flex: 0 0 auto;
            width: 25%
        }

        .col-4 {
            flex: 0 0 auto;
            width: 33.33333333%
        }

        .col-5 {
            flex: 0 0 auto;
            width: 41.66666667%
        }

        .col-6 {
            flex: 0 0 auto;
            width: 50%
        }

        .col-7 {
            flex: 0 0 auto;
            width: 58.33333333%
        }

        .col-8 {
            flex: 0 0 auto;
            width: 66.66666667%
        }

        .col-9 {
            flex: 0 0 auto;
            width: 75%
        }

        .col-10 {
            flex: 0 0 auto;
            width: 83.33333333%
        }

        .col-11 {
            flex: 0 0 auto;
            width: 91.66666667%
        }

        .col-12 {
            flex: 0 0 auto;
            width: 100%
        }

        .offset-1 {
            margin-left: 8.33333333%
        }

        .offset-2 {
            margin-left: 16.66666667%
        }

        .offset-3 {
            margin-left: 25%
        }

        .offset-4 {
            margin-left: 33.33333333%
        }

        .offset-5 {
            margin-left: 41.66666667%
        }

        .offset-6 {
            margin-left: 50%
        }

        .offset-7 {
            margin-left: 58.33333333%
        }

        .offset-8 {
            margin-left: 66.66666667%
        }

        .offset-9 {
            margin-left: 75%
        }

        .offset-10 {
            margin-left: 83.33333333%
        }

        .offset-11 {
            margin-left: 91.66666667%
        }

        .g-0,
        .gx-0 {
            --bs-gutter-x: 0
        }

        .g-0,
        .gy-0 {
            --bs-gutter-y: 0
        }

        .g-1,
        .gx-1 {
            --bs-gutter-x: 0.25rem
        }

        .g-1,
        .gy-1 {
            --bs-gutter-y: 0.25rem
        }

        .g-2,
        .gx-2 {
            --bs-gutter-x: 0.5rem
        }

        .g-2,
        .gy-2 {
            --bs-gutter-y: 0.5rem
        }

        .g-3,
        .gx-3 {
            --bs-gutter-x: 1rem
        }

        .g-3,
        .gy-3 {
            --bs-gutter-y: 1rem
        }

        .g-4,
        .gx-4 {
            --bs-gutter-x: 1.5rem
        }

        .g-4,
        .gy-4 {
            --bs-gutter-y: 1.5rem
        }

        .g-5,
        .gx-5 {
            --bs-gutter-x: 3rem
        }

        .g-5,
        .gy-5 {
            --bs-gutter-y: 3rem
        }

        @media (min-width:576px) {
            .col-sm {
                flex: 1 0 0%
            }

            .row-cols-sm-auto>* {
                flex: 0 0 auto;
                width: auto
            }

            .row-cols-sm-1>* {
                flex: 0 0 auto;
                width: 100%
            }

            .row-cols-sm-2>* {
                flex: 0 0 auto;
                width: 50%
            }

            .row-cols-sm-3>* {
                flex: 0 0 auto;
                width: 33.3333333333%
            }

            .row-cols-sm-4>* {
                flex: 0 0 auto;
                width: 25%
            }

            .row-cols-sm-5>* {
                flex: 0 0 auto;
                width: 20%
            }

            .row-cols-sm-6>* {
                flex: 0 0 auto;
                width: 16.6666666667%
            }

            .col-sm-auto {
                flex: 0 0 auto;
                width: auto
            }

            .col-sm-1 {
                flex: 0 0 auto;
                width: 8.33333333%
            }

            .col-sm-2 {
                flex: 0 0 auto;
                width: 16.66666667%
            }

            .col-sm-3 {
                flex: 0 0 auto;
                width: 25%
            }

            .col-sm-4 {
                flex: 0 0 auto;
                width: 33.33333333%
            }

            .col-sm-5 {
                flex: 0 0 auto;
                width: 41.66666667%
            }

            .col-sm-6 {
                flex: 0 0 auto;
                width: 50%
            }

            .col-sm-7 {
                flex: 0 0 auto;
                width: 58.33333333%
            }

            .col-sm-8 {
                flex: 0 0 auto;
                width: 66.66666667%
            }

            .col-sm-9 {
                flex: 0 0 auto;
                width: 75%
            }

            .col-sm-10 {
                flex: 0 0 auto;
                width: 83.33333333%
            }

            .col-sm-11 {
                flex: 0 0 auto;
                width: 91.66666667%
            }

            .col-sm-12 {
                flex: 0 0 auto;
                width: 100%
            }

            .offset-sm-0 {
                margin-left: 0
            }

            .offset-sm-1 {
                margin-left: 8.33333333%
            }

            .offset-sm-2 {
                margin-left: 16.66666667%
            }

            .offset-sm-3 {
                margin-left: 25%
            }

            .offset-sm-4 {
                margin-left: 33.33333333%
            }

            .offset-sm-5 {
                margin-left: 41.66666667%
            }

            .offset-sm-6 {
                margin-left: 50%
            }

            .offset-sm-7 {
                margin-left: 58.33333333%
            }

            .offset-sm-8 {
                margin-left: 66.66666667%
            }

            .offset-sm-9 {
                margin-left: 75%
            }

            .offset-sm-10 {
                margin-left: 83.33333333%
            }

            .offset-sm-11 {
                margin-left: 91.66666667%
            }

            .g-sm-0,
            .gx-sm-0 {
                --bs-gutter-x: 0
            }

            .g-sm-0,
            .gy-sm-0 {
                --bs-gutter-y: 0
            }

            .g-sm-1,
            .gx-sm-1 {
                --bs-gutter-x: 0.25rem
            }

            .g-sm-1,
            .gy-sm-1 {
                --bs-gutter-y: 0.25rem
            }

            .g-sm-2,
            .gx-sm-2 {
                --bs-gutter-x: 0.5rem
            }

            .g-sm-2,
            .gy-sm-2 {
                --bs-gutter-y: 0.5rem
            }

            .g-sm-3,
            .gx-sm-3 {
                --bs-gutter-x: 1rem
            }

            .g-sm-3,
            .gy-sm-3 {
                --bs-gutter-y: 1rem
            }

            .g-sm-4,
            .gx-sm-4 {
                --bs-gutter-x: 1.5rem
            }

            .g-sm-4,
            .gy-sm-4 {
                --bs-gutter-y: 1.5rem
            }

            .g-sm-5,
            .gx-sm-5 {
                --bs-gutter-x: 3rem
            }

            .g-sm-5,
            .gy-sm-5 {
                --bs-gutter-y: 3rem
            }
        }

        @media (min-width:768px) {
            .col-md {
                flex: 1 0 0%
            }

            .row-cols-md-auto>* {
                flex: 0 0 auto;
                width: auto
            }

            .row-cols-md-1>* {
                flex: 0 0 auto;
                width: 100%
            }

            .row-cols-md-2>* {
                flex: 0 0 auto;
                width: 50%
            }

            .row-cols-md-3>* {
                flex: 0 0 auto;
                width: 33.3333333333%
            }

            .row-cols-md-4>* {
                flex: 0 0 auto;
                width: 25%
            }

            .row-cols-md-5>* {
                flex: 0 0 auto;
                width: 20%
            }

            .row-cols-md-6>* {
                flex: 0 0 auto;
                width: 16.6666666667%
            }

            .col-md-auto {
                flex: 0 0 auto;
                width: auto
            }

            .col-md-1 {
                flex: 0 0 auto;
                width: 8.33333333%
            }

            .col-md-2 {
                flex: 0 0 auto;
                width: 16.66666667%
            }

            .col-md-3 {
                flex: 0 0 auto;
                width: 25%
            }

            .col-md-4 {
                flex: 0 0 auto;
                width: 33.33333333%
            }

            .col-md-5 {
                flex: 0 0 auto;
                width: 41.66666667%
            }

            .col-md-6 {
                flex: 0 0 auto;
                width: 50%
            }

            .col-md-7 {
                flex: 0 0 auto;
                width: 58.33333333%
            }

            .col-md-8 {
                flex: 0 0 auto;
                width: 66.66666667%
            }

            .col-md-9 {
                flex: 0 0 auto;
                width: 75%
            }

            .col-md-10 {
                flex: 0 0 auto;
                width: 83.33333333%
            }

            .col-md-11 {
                flex: 0 0 auto;
                width: 91.66666667%
            }

            .col-md-12 {
                flex: 0 0 auto;
                width: 100%
            }

            .offset-md-0 {
                margin-left: 0
            }

            .offset-md-1 {
                margin-left: 8.33333333%
            }

            .offset-md-2 {
                margin-left: 16.66666667%
            }

            .offset-md-3 {
                margin-left: 25%
            }

            .offset-md-4 {
                margin-left: 33.33333333%
            }

            .offset-md-5 {
                margin-left: 41.66666667%
            }

            .offset-md-6 {
                margin-left: 50%
            }

            .offset-md-7 {
                margin-left: 58.33333333%
            }

            .offset-md-8 {
                margin-left: 66.66666667%
            }

            .offset-md-9 {
                margin-left: 75%
            }

            .offset-md-10 {
                margin-left: 83.33333333%
            }

            .offset-md-11 {
                margin-left: 91.66666667%
            }

            .g-md-0,
            .gx-md-0 {
                --bs-gutter-x: 0
            }

            .g-md-0,
            .gy-md-0 {
                --bs-gutter-y: 0
            }

            .g-md-1,
            .gx-md-1 {
                --bs-gutter-x: 0.25rem
            }

            .g-md-1,
            .gy-md-1 {
                --bs-gutter-y: 0.25rem
            }

            .g-md-2,
            .gx-md-2 {
                --bs-gutter-x: 0.5rem
            }

            .g-md-2,
            .gy-md-2 {
                --bs-gutter-y: 0.5rem
            }

            .g-md-3,
            .gx-md-3 {
                --bs-gutter-x: 1rem
            }

            .g-md-3,
            .gy-md-3 {
                --bs-gutter-y: 1rem
            }

            .g-md-4,
            .gx-md-4 {
                --bs-gutter-x: 1.5rem
            }

            .g-md-4,
            .gy-md-4 {
                --bs-gutter-y: 1.5rem
            }

            .g-md-5,
            .gx-md-5 {
                --bs-gutter-x: 3rem
            }

            .g-md-5,
            .gy-md-5 {
                --bs-gutter-y: 3rem
            }
        }

        @media (min-width:992px) {
            .col-lg {
                flex: 1 0 0%
            }

            .row-cols-lg-auto>* {
                flex: 0 0 auto;
                width: auto
            }

            .row-cols-lg-1>* {
                flex: 0 0 auto;
                width: 100%
            }

            .row-cols-lg-2>* {
                flex: 0 0 auto;
                width: 50%
            }

            .row-cols-lg-3>* {
                flex: 0 0 auto;
                width: 33.3333333333%
            }

            .row-cols-lg-4>* {
                flex: 0 0 auto;
                width: 25%
            }

            .row-cols-lg-5>* {
                flex: 0 0 auto;
                width: 20%
            }

            .row-cols-lg-6>* {
                flex: 0 0 auto;
                width: 16.6666666667%
            }

            .col-lg-auto {
                flex: 0 0 auto;
                width: auto
            }

            .col-lg-1 {
                flex: 0 0 auto;
                width: 8.33333333%
            }

            .col-lg-2 {
                flex: 0 0 auto;
                width: 16.66666667%
            }

            .col-lg-3 {
                flex: 0 0 auto;
                width: 25%
            }

            .col-lg-4 {
                flex: 0 0 auto;
                width: 33.33333333%
            }

            .col-lg-5 {
                flex: 0 0 auto;
                width: 41.66666667%
            }

            .col-lg-6 {
                flex: 0 0 auto;
                width: 50%
            }

            .col-lg-7 {
                flex: 0 0 auto;
                width: 58.33333333%
            }

            .col-lg-8 {
                flex: 0 0 auto;
                width: 66.66666667%
            }

            .col-lg-9 {
                flex: 0 0 auto;
                width: 75%
            }

            .col-lg-10 {
                flex: 0 0 auto;
                width: 83.33333333%
            }

            .col-lg-11 {
                flex: 0 0 auto;
                width: 91.66666667%
            }

            .col-lg-12 {
                flex: 0 0 auto;
                width: 100%
            }

            .offset-lg-0 {
                margin-left: 0
            }

            .offset-lg-1 {
                margin-left: 8.33333333%
            }

            .offset-lg-2 {
                margin-left: 16.66666667%
            }

            .offset-lg-3 {
                margin-left: 25%
            }

            .offset-lg-4 {
                margin-left: 33.33333333%
            }

            .offset-lg-5 {
                margin-left: 41.66666667%
            }

            .offset-lg-6 {
                margin-left: 50%
            }

            .offset-lg-7 {
                margin-left: 58.33333333%
            }

            .offset-lg-8 {
                margin-left: 66.66666667%
            }

            .offset-lg-9 {
                margin-left: 75%
            }

            .offset-lg-10 {
                margin-left: 83.33333333%
            }

            .offset-lg-11 {
                margin-left: 91.66666667%
            }

            .g-lg-0,
            .gx-lg-0 {
                --bs-gutter-x: 0
            }

            .g-lg-0,
            .gy-lg-0 {
                --bs-gutter-y: 0
            }

            .g-lg-1,
            .gx-lg-1 {
                --bs-gutter-x: 0.25rem
            }

            .g-lg-1,
            .gy-lg-1 {
                --bs-gutter-y: 0.25rem
            }

            .g-lg-2,
            .gx-lg-2 {
                --bs-gutter-x: 0.5rem
            }

            .g-lg-2,
            .gy-lg-2 {
                --bs-gutter-y: 0.5rem
            }

            .g-lg-3,
            .gx-lg-3 {
                --bs-gutter-x: 1rem
            }

            .g-lg-3,
            .gy-lg-3 {
                --bs-gutter-y: 1rem
            }

            .g-lg-4,
            .gx-lg-4 {
                --bs-gutter-x: 1.5rem
            }

            .g-lg-4,
            .gy-lg-4 {
                --bs-gutter-y: 1.5rem
            }

            .g-lg-5,
            .gx-lg-5 {
                --bs-gutter-x: 3rem
            }

            .g-lg-5,
            .gy-lg-5 {
                --bs-gutter-y: 3rem
            }
        }

        @media (min-width:1200px) {
            .col-xl {
                flex: 1 0 0%
            }

            .row-cols-xl-auto>* {
                flex: 0 0 auto;
                width: auto
            }

            .row-cols-xl-1>* {
                flex: 0 0 auto;
                width: 100%
            }

            .row-cols-xl-2>* {
                flex: 0 0 auto;
                width: 50%
            }

            .row-cols-xl-3>* {
                flex: 0 0 auto;
                width: 33.3333333333%
            }

            .row-cols-xl-4>* {
                flex: 0 0 auto;
                width: 25%
            }

            .row-cols-xl-5>* {
                flex: 0 0 auto;
                width: 20%
            }

            .row-cols-xl-6>* {
                flex: 0 0 auto;
                width: 16.6666666667%
            }

            .col-xl-auto {
                flex: 0 0 auto;
                width: auto
            }

            .col-xl-1 {
                flex: 0 0 auto;
                width: 8.33333333%
            }

            .col-xl-2 {
                flex: 0 0 auto;
                width: 16.66666667%
            }

            .col-xl-3 {
                flex: 0 0 auto;
                width: 25%
            }

            .col-xl-4 {
                flex: 0 0 auto;
                width: 33.33333333%
            }

            .col-xl-5 {
                flex: 0 0 auto;
                width: 41.66666667%
            }

            .col-xl-6 {
                flex: 0 0 auto;
                width: 50%
            }

            .col-xl-7 {
                flex: 0 0 auto;
                width: 58.33333333%
            }

            .col-xl-8 {
                flex: 0 0 auto;
                width: 66.66666667%
            }

            .col-xl-9 {
                flex: 0 0 auto;
                width: 75%
            }

            .col-xl-10 {
                flex: 0 0 auto;
                width: 83.33333333%
            }

            .col-xl-11 {
                flex: 0 0 auto;
                width: 91.66666667%
            }

            .col-xl-12 {
                flex: 0 0 auto;
                width: 100%
            }

            .offset-xl-0 {
                margin-left: 0
            }

            .offset-xl-1 {
                margin-left: 8.33333333%
            }

            .offset-xl-2 {
                margin-left: 16.66666667%
            }

            .offset-xl-3 {
                margin-left: 25%
            }

            .offset-xl-4 {
                margin-left: 33.33333333%
            }

            .offset-xl-5 {
                margin-left: 41.66666667%
            }

            .offset-xl-6 {
                margin-left: 50%
            }

            .offset-xl-7 {
                margin-left: 58.33333333%
            }

            .offset-xl-8 {
                margin-left: 66.66666667%
            }

            .offset-xl-9 {
                margin-left: 75%
            }

            .offset-xl-10 {
                margin-left: 83.33333333%
            }

            .offset-xl-11 {
                margin-left: 91.66666667%
            }

            .g-xl-0,
            .gx-xl-0 {
                --bs-gutter-x: 0
            }

            .g-xl-0,
            .gy-xl-0 {
                --bs-gutter-y: 0
            }

            .g-xl-1,
            .gx-xl-1 {
                --bs-gutter-x: 0.25rem
            }

            .g-xl-1,
            .gy-xl-1 {
                --bs-gutter-y: 0.25rem
            }

            .g-xl-2,
            .gx-xl-2 {
                --bs-gutter-x: 0.5rem
            }

            .g-xl-2,
            .gy-xl-2 {
                --bs-gutter-y: 0.5rem
            }

            .g-xl-3,
            .gx-xl-3 {
                --bs-gutter-x: 1rem
            }

            .g-xl-3,
            .gy-xl-3 {
                --bs-gutter-y: 1rem
            }

            .g-xl-4,
            .gx-xl-4 {
                --bs-gutter-x: 1.5rem
            }

            .g-xl-4,
            .gy-xl-4 {
                --bs-gutter-y: 1.5rem
            }

            .g-xl-5,
            .gx-xl-5 {
                --bs-gutter-x: 3rem
            }

            .g-xl-5,
            .gy-xl-5 {
                --bs-gutter-y: 3rem
            }
        }

        @media (min-width:1400px) {
            .col-xxl {
                flex: 1 0 0%
            }

            .row-cols-xxl-auto>* {
                flex: 0 0 auto;
                width: auto
            }

            .row-cols-xxl-1>* {
                flex: 0 0 auto;
                width: 100%
            }

            .row-cols-xxl-2>* {
                flex: 0 0 auto;
                width: 50%
            }

            .row-cols-xxl-3>* {
                flex: 0 0 auto;
                width: 33.3333333333%
            }

            .row-cols-xxl-4>* {
                flex: 0 0 auto;
                width: 25%
            }

            .row-cols-xxl-5>* {
                flex: 0 0 auto;
                width: 20%
            }

            .row-cols-xxl-6>* {
                flex: 0 0 auto;
                width: 16.6666666667%
            }

            .col-xxl-auto {
                flex: 0 0 auto;
                width: auto
            }

            .col-xxl-1 {
                flex: 0 0 auto;
                width: 8.33333333%
            }

            .col-xxl-2 {
                flex: 0 0 auto;
                width: 16.66666667%
            }

            .col-xxl-3 {
                flex: 0 0 auto;
                width: 25%
            }

            .col-xxl-4 {
                flex: 0 0 auto;
                width: 33.33333333%
            }

            .col-xxl-5 {
                flex: 0 0 auto;
                width: 41.66666667%
            }

            .col-xxl-6 {
                flex: 0 0 auto;
                width: 50%
            }

            .col-xxl-7 {
                flex: 0 0 auto;
                width: 58.33333333%
            }

            .col-xxl-8 {
                flex: 0 0 auto;
                width: 66.66666667%
            }

            .col-xxl-9 {
                flex: 0 0 auto;
                width: 75%
            }

            .col-xxl-10 {
                flex: 0 0 auto;
                width: 83.33333333%
            }

            .col-xxl-11 {
                flex: 0 0 auto;
                width: 91.66666667%
            }

            .col-xxl-12 {
                flex: 0 0 auto;
                width: 100%
            }

            .offset-xxl-0 {
                margin-left: 0
            }

            .offset-xxl-1 {
                margin-left: 8.33333333%
            }

            .offset-xxl-2 {
                margin-left: 16.66666667%
            }

            .offset-xxl-3 {
                margin-left: 25%
            }

            .offset-xxl-4 {
                margin-left: 33.33333333%
            }

            .offset-xxl-5 {
                margin-left: 41.66666667%
            }

            .offset-xxl-6 {
                margin-left: 50%
            }

            .offset-xxl-7 {
                margin-left: 58.33333333%
            }

            .offset-xxl-8 {
                margin-left: 66.66666667%
            }

            .offset-xxl-9 {
                margin-left: 75%
            }

            .offset-xxl-10 {
                margin-left: 83.33333333%
            }

            .offset-xxl-11 {
                margin-left: 91.66666667%
            }

            .g-xxl-0,
            .gx-xxl-0 {
                --bs-gutter-x: 0
            }

            .g-xxl-0,
            .gy-xxl-0 {
                --bs-gutter-y: 0
            }

            .g-xxl-1,
            .gx-xxl-1 {
                --bs-gutter-x: 0.25rem
            }

            .g-xxl-1,
            .gy-xxl-1 {
                --bs-gutter-y: 0.25rem
            }

            .g-xxl-2,
            .gx-xxl-2 {
                --bs-gutter-x: 0.5rem
            }

            .g-xxl-2,
            .gy-xxl-2 {
                --bs-gutter-y: 0.5rem
            }

            .g-xxl-3,
            .gx-xxl-3 {
                --bs-gutter-x: 1rem
            }

            .g-xxl-3,
            .gy-xxl-3 {
                --bs-gutter-y: 1rem
            }

            .g-xxl-4,
            .gx-xxl-4 {
                --bs-gutter-x: 1.5rem
            }

            .g-xxl-4,
            .gy-xxl-4 {
                --bs-gutter-y: 1.5rem
            }

            .g-xxl-5,
            .gx-xxl-5 {
                --bs-gutter-x: 3rem
            }

            .g-xxl-5,
            .gy-xxl-5 {
                --bs-gutter-y: 3rem
            }
        }

        .table {
            --bs-table-color-type: initial;
            --bs-table-bg-type: initial;
            --bs-table-color-state: initial;
            --bs-table-bg-state: initial;
            --bs-table-color: var(--bs-body-color);
            --bs-table-bg: var(--bs-body-bg);
            --bs-table-border-color: var(--bs-border-color);
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: var(--bs-body-color);
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: var(--bs-body-color);
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: var(--bs-body-color);
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            vertical-align: top;
            border-color: var(--bs-table-border-color)
        }

        .table>:not(caption)>*>* {
            padding: .5rem .5rem;
            color: var(--bs-table-color-state, var(--bs-table-color-type, var(--bs-table-color)));
            background-color: var(--bs-table-bg);
            border-bottom-width: var(--bs-border-width);
            box-shadow: inset 0 0 0 9999px var(--bs-table-bg-state, var(--bs-table-bg-type, var(--bs-table-accent-bg)))
        }

        .table>tbody {
            vertical-align: inherit
        }

        .table>thead {
            vertical-align: bottom
        }

        .table-group-divider {
            border-top: calc(var(--bs-border-width) * 2) solid currentcolor
        }

        .caption-top {
            caption-side: top
        }

        .table-sm>:not(caption)>*>* {
            padding: .25rem .25rem
        }

        .table-bordered>:not(caption)>* {
            border-width: var(--bs-border-width) 0
        }

        .table-bordered>:not(caption)>*>* {
            border-width: 0 var(--bs-border-width)
        }

        .table-borderless>:not(caption)>*>* {
            border-bottom-width: 0
        }

        .table-borderless>:not(:first-child) {
            border-top-width: 0
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            --bs-table-color-type: var(--bs-table-striped-color);
            --bs-table-bg-type: var(--bs-table-striped-bg)
        }

        .table-striped-columns>:not(caption)>tr>:nth-child(2n) {
            --bs-table-color-type: var(--bs-table-striped-color);
            --bs-table-bg-type: var(--bs-table-striped-bg)
        }

        .table-active {
            --bs-table-color-state: var(--bs-table-active-color);
            --bs-table-bg-state: var(--bs-table-active-bg)
        }

        .table-hover>tbody>tr:hover>* {
            --bs-table-color-state: var(--bs-table-hover-color);
            --bs-table-bg-state: var(--bs-table-hover-bg)
        }

        .table-primary {
            --bs-table-color: #000;
            --bs-table-bg: #cfe2ff;
            --bs-table-border-color: #bacbe6;
            --bs-table-striped-bg: #c5d7f2;
            --bs-table-striped-color: #000;
            --bs-table-active-bg: #bacbe6;
            --bs-table-active-color: #000;
            --bs-table-hover-bg: #bfd1ec;
            --bs-table-hover-color: #000;
            color: var(--bs-table-color);
            border-color: var(--bs-table-border-color)
        }

        .table-secondary {
            --bs-table-color: #000;
            --bs-table-bg: #e2e3e5;
            --bs-table-border-color: #cbccce;
            --bs-table-striped-bg: #d7d8da;
            --bs-table-striped-color: #000;
            --bs-table-active-bg: #cbccce;
            --bs-table-active-color: #000;
            --bs-table-hover-bg: #d1d2d4;
            --bs-table-hover-color: #000;
            color: var(--bs-table-color);
            border-color: var(--bs-table-border-color)
        }

        .table-success {
            --bs-table-color: #000;
            --bs-table-bg: #d1e7dd;
            --bs-table-border-color: #bcd0c7;
            --bs-table-striped-bg: #c7dbd2;
            --bs-table-striped-color: #000;
            --bs-table-active-bg: #bcd0c7;
            --bs-table-active-color: #000;
            --bs-table-hover-bg: #c1d6cc;
            --bs-table-hover-color: #000;
            color: var(--bs-table-color);
            border-color: var(--bs-table-border-color)
        }

        .table-info {
            --bs-table-color: #000;
            --bs-table-bg: #cff4fc;
            --bs-table-border-color: #badce3;
            --bs-table-striped-bg: #c5e8ef;
            --bs-table-striped-color: #000;
            --bs-table-active-bg: #badce3;
            --bs-table-active-color: #000;
            --bs-table-hover-bg: #bfe2e9;
            --bs-table-hover-color: #000;
            color: var(--bs-table-color);
            border-color: var(--bs-table-border-color)
        }

        .table-warning {
            --bs-table-color: #000;
            --bs-table-bg: #fff3cd;
            --bs-table-border-color: #e6dbb9;
            --bs-table-striped-bg: #f2e7c3;
            --bs-table-striped-color: #000;
            --bs-table-active-bg: #e6dbb9;
            --bs-table-active-color: #000;
            --bs-table-hover-bg: #ece1be;
            --bs-table-hover-color: #000;
            color: var(--bs-table-color);
            border-color: var(--bs-table-border-color)
        }

        .table-danger {
            --bs-table-color: #000;
            --bs-table-bg: #f8d7da;
            --bs-table-border-color: #dfc2c4;
            --bs-table-striped-bg: #eccccf;
            --bs-table-striped-color: #000;
            --bs-table-active-bg: #dfc2c4;
            --bs-table-active-color: #000;
            --bs-table-hover-bg: #e5c7ca;
            --bs-table-hover-color: #000;
            color: var(--bs-table-color);
            border-color: var(--bs-table-border-color)
        }

        .table-light {
            --bs-table-color: #000;
            --bs-table-bg: #f8f9fa;
            --bs-table-border-color: #dfe0e1;
            --bs-table-striped-bg: #ecedee;
            --bs-table-striped-color: #000;
            --bs-table-active-bg: #dfe0e1;
            --bs-table-active-color: #000;
            --bs-table-hover-bg: #e5e6e7;
            --bs-table-hover-color: #000;
            color: var(--bs-table-color);
            border-color: var(--bs-table-border-color)
        }

        .table-dark {
            --bs-table-color: #fff;
            --bs-table-bg: #212529;
            --bs-table-border-color: #373b3e;
            --bs-table-striped-bg: #2c3034;
            --bs-table-striped-color: #fff;
            --bs-table-active-bg: #373b3e;
            --bs-table-active-color: #fff;
            --bs-table-hover-bg: #323539;
            --bs-table-hover-color: #fff;
            color: var(--bs-table-color);
            border-color: var(--bs-table-border-color)
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch
        }

        @media (max-width:575.98px) {
            .table-responsive-sm {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }
        }

        @media (max-width:767.98px) {
            .table-responsive-md {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }
        }

        @media (max-width:991.98px) {
            .table-responsive-lg {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }
        }

        @media (max-width:1199.98px) {
            .table-responsive-xl {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }
        }

        @media (max-width:1399.98px) {
            .table-responsive-xxl {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch
            }
        }

        .form-label {
            margin-bottom: .5rem
        }

        .col-form-label {
            padding-top: calc(.375rem + var(--bs-border-width));
            padding-bottom: calc(.375rem + var(--bs-border-width));
            margin-bottom: 0;
            font-size: inherit;
            line-height: 1.5
        }

        .col-form-label-lg {
            padding-top: calc(.5rem + var(--bs-border-width));
            padding-bottom: calc(.5rem + var(--bs-border-width));
            font-size: 1.25rem
        }

        .col-form-label-sm {
            padding-top: calc(.25rem + var(--bs-border-width));
            padding-bottom: calc(.25rem + var(--bs-border-width));
            font-size: .875rem
        }

        .form-text {
            margin-top: .25rem;
            font-size: .875em;
            color: var(--bs-secondary-color)
        }

        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            background-clip: padding-box;
            border: var(--bs-border-width) solid var(--bs-border-color);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: var(--bs-border-radius);
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .form-control {
                transition: none
            }
        }

        .form-control[type=file] {
            overflow: hidden
        }

        .form-control[type=file]:not(:disabled):not([readonly]) {
            cursor: pointer
        }

        .form-control:focus {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25)
        }

        .form-control::-webkit-date-and-time-value {
            min-width: 85px;
            height: 1.5em;
            margin: 0
        }

        .form-control::-webkit-datetime-edit {
            display: block;
            padding: 0
        }

        .form-control::-moz-placeholder {
            color: var(--bs-secondary-color);
            opacity: 1
        }

        .form-control::placeholder {
            color: var(--bs-secondary-color);
            opacity: 1
        }

        .form-control:disabled {
            background-color: var(--bs-secondary-bg);
            opacity: 1
        }

        .form-control::-webkit-file-upload-button {
            padding: .375rem .75rem;
            margin: -.375rem -.75rem;
            -webkit-margin-end: .75rem;
            margin-inline-end: .75rem;
            color: var(--bs-body-color);
            background-color: var(--bs-tertiary-bg);
            pointer-events: none;
            border-color: inherit;
            border-style: solid;
            border-width: 0;
            border-inline-end-width: var(--bs-border-width);
            border-radius: 0;
            -webkit-transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        .form-control::file-selector-button {
            padding: .375rem .75rem;
            margin: -.375rem -.75rem;
            -webkit-margin-end: .75rem;
            margin-inline-end: .75rem;
            color: var(--bs-body-color);
            background-color: var(--bs-tertiary-bg);
            pointer-events: none;
            border-color: inherit;
            border-style: solid;
            border-width: 0;
            border-inline-end-width: var(--bs-border-width);
            border-radius: 0;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .form-control::-webkit-file-upload-button {
                -webkit-transition: none;
                transition: none
            }

            .form-control::file-selector-button {
                transition: none
            }
        }

        .form-control:hover:not(:disabled):not([readonly])::-webkit-file-upload-button {
            background-color: var(--bs-secondary-bg)
        }

        .form-control:hover:not(:disabled):not([readonly])::file-selector-button {
            background-color: var(--bs-secondary-bg)
        }

        .form-control-plaintext {
            display: block;
            width: 100%;
            padding: .375rem 0;
            margin-bottom: 0;
            line-height: 1.5;
            color: var(--bs-body-color);
            background-color: transparent;
            border: solid transparent;
            border-width: var(--bs-border-width) 0
        }

        .form-control-plaintext:focus {
            outline: 0
        }

        .form-control-plaintext.form-control-lg,
        .form-control-plaintext.form-control-sm {
            padding-right: 0;
            padding-left: 0
        }

        .form-control-sm {
            min-height: calc(1.5em + .5rem + calc(var(--bs-border-width) * 2));
            padding: .25rem .5rem;
            font-size: .875rem;
            border-radius: var(--bs-border-radius-sm)
        }

        .form-control-sm::-webkit-file-upload-button {
            padding: .25rem .5rem;
            margin: -.25rem -.5rem;
            -webkit-margin-end: .5rem;
            margin-inline-end: .5rem
        }

        .form-control-sm::file-selector-button {
            padding: .25rem .5rem;
            margin: -.25rem -.5rem;
            -webkit-margin-end: .5rem;
            margin-inline-end: .5rem
        }

        .form-control-lg {
            min-height: calc(1.5em + 1rem + calc(var(--bs-border-width) * 2));
            padding: .5rem 1rem;
            font-size: 1.25rem;
            border-radius: var(--bs-border-radius-lg)
        }

        .form-control-lg::-webkit-file-upload-button {
            padding: .5rem 1rem;
            margin: -.5rem -1rem;
            -webkit-margin-end: 1rem;
            margin-inline-end: 1rem
        }

        .form-control-lg::file-selector-button {
            padding: .5rem 1rem;
            margin: -.5rem -1rem;
            -webkit-margin-end: 1rem;
            margin-inline-end: 1rem
        }

        textarea.form-control {
            min-height: calc(1.5em + .75rem + calc(var(--bs-border-width) * 2))
        }

        textarea.form-control-sm {
            min-height: calc(1.5em + .5rem + calc(var(--bs-border-width) * 2))
        }

        textarea.form-control-lg {
            min-height: calc(1.5em + 1rem + calc(var(--bs-border-width) * 2))
        }

        .form-control-color {
            width: 3rem;
            height: calc(1.5em + .75rem + calc(var(--bs-border-width) * 2));
            padding: .375rem
        }

        .form-control-color:not(:disabled):not([readonly]) {
            cursor: pointer
        }

        .form-control-color::-moz-color-swatch {
            border: 0 !important;
            border-radius: var(--bs-border-radius)
        }

        .form-control-color::-webkit-color-swatch {
            border: 0 !important;
            border-radius: var(--bs-border-radius)
        }

        .form-control-color.form-control-sm {
            height: calc(1.5em + .5rem + calc(var(--bs-border-width) * 2))
        }

        .form-control-color.form-control-lg {
            height: calc(1.5em + 1rem + calc(var(--bs-border-width) * 2))
        }

        .form-select {
            --bs-form-select-bg-img: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            display: block;
            width: 100%;
            padding: .375rem 2.25rem .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
            background-repeat: no-repeat;
            background-position: right .75rem center;
            background-size: 16px 12px;
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none
        }

        @media (prefers-reduced-motion:reduce) {
            .form-select {
                transition: none
            }
        }

        .form-select:focus {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25)
        }

        .form-select[multiple],
        .form-select[size]:not([size="1"]) {
            padding-right: .75rem;
            background-image: none
        }

        .form-select:disabled {
            background-color: var(--bs-secondary-bg)
        }

        .form-select:-moz-focusring {
            color: transparent;
            text-shadow: 0 0 0 var(--bs-body-color)
        }

        .form-select-sm {
            padding-top: .25rem;
            padding-bottom: .25rem;
            padding-left: .5rem;
            font-size: .875rem;
            border-radius: var(--bs-border-radius-sm)
        }

        .form-select-lg {
            padding-top: .5rem;
            padding-bottom: .5rem;
            padding-left: 1rem;
            font-size: 1.25rem;
            border-radius: var(--bs-border-radius-lg)
        }

        [data-bs-theme=dark] .form-select {
            --bs-form-select-bg-img: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23adb5bd' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e")
        }

        .form-check {
            display: block;
            min-height: 1.5rem;
            padding-left: 1.5em;
            margin-bottom: .125rem
        }

        .form-check .form-check-input {
            float: left;
            margin-left: -1.5em
        }

        .form-check-reverse {
            padding-right: 1.5em;
            padding-left: 0;
            text-align: right
        }

        .form-check-reverse .form-check-input {
            float: right;
            margin-right: -1.5em;
            margin-left: 0
        }

        .form-check-input {
            --bs-form-check-bg: var(--bs-body-bg);
            width: 1em;
            height: 1em;
            margin-top: .25em;
            vertical-align: top;
            background-color: var(--bs-form-check-bg);
            background-image: var(--bs-form-check-bg-image);
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            border: var(--bs-border-width) solid var(--bs-border-color);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            print-color-adjust: exact
        }

        .form-check-input[type=checkbox] {
            border-radius: .25em
        }

        .form-check-input[type=radio] {
            border-radius: 50%
        }

        .form-check-input:active {
            filter: brightness(90%)
        }

        .form-check-input:focus {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25)
        }

        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd
        }

        .form-check-input:checked[type=checkbox] {
            --bs-form-check-bg-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e")
        }

        .form-check-input:checked[type=radio] {
            --bs-form-check-bg-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e")
        }

        .form-check-input[type=checkbox]:indeterminate {
            background-color: #0d6efd;
            border-color: #0d6efd;
            --bs-form-check-bg-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10h8'/%3e%3c/svg%3e")
        }

        .form-check-input:disabled {
            pointer-events: none;
            filter: none;
            opacity: .5
        }

        .form-check-input:disabled~.form-check-label,
        .form-check-input[disabled]~.form-check-label {
            cursor: default;
            opacity: .5
        }

        .form-switch {
            padding-left: 2.5em
        }

        .form-switch .form-check-input {
            --bs-form-switch-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
            width: 2em;
            margin-left: -2.5em;
            background-image: var(--bs-form-switch-bg);
            background-position: left center;
            border-radius: 2em;
            transition: background-position .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .form-switch .form-check-input {
                transition: none
            }
        }

        .form-switch .form-check-input:focus {
            --bs-form-switch-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%2386b7fe'/%3e%3c/svg%3e")
        }

        .form-switch .form-check-input:checked {
            background-position: right center;
            --bs-form-switch-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e")
        }

        .form-switch.form-check-reverse {
            padding-right: 2.5em;
            padding-left: 0
        }

        .form-switch.form-check-reverse .form-check-input {
            margin-right: -2.5em;
            margin-left: 0
        }

        .form-check-inline {
            display: inline-block;
            margin-right: 1rem
        }

        .btn-check {
            position: absolute;
            clip: rect(0, 0, 0, 0);
            pointer-events: none
        }

        .btn-check:disabled+.btn,
        .btn-check[disabled]+.btn {
            pointer-events: none;
            filter: none;
            opacity: .65
        }

        [data-bs-theme=dark] .form-switch .form-check-input:not(:checked):not(:focus) {
            --bs-form-switch-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%28255, 255, 255, 0.25%29'/%3e%3c/svg%3e")
        }

        .form-range {
            width: 100%;
            height: 1.5rem;
            padding: 0;
            background-color: transparent;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none
        }

        .form-range:focus {
            outline: 0
        }

        .form-range:focus::-webkit-slider-thumb {
            box-shadow: 0 0 0 1px #fff, 0 0 0 .25rem rgba(13, 110, 253, .25)
        }

        .form-range:focus::-moz-range-thumb {
            box-shadow: 0 0 0 1px #fff, 0 0 0 .25rem rgba(13, 110, 253, .25)
        }

        .form-range::-moz-focus-outer {
            border: 0
        }

        .form-range::-webkit-slider-thumb {
            width: 1rem;
            height: 1rem;
            margin-top: -.25rem;
            background-color: #0d6efd;
            border: 0;
            border-radius: 1rem;
            -webkit-transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            -webkit-appearance: none;
            appearance: none
        }

        @media (prefers-reduced-motion:reduce) {
            .form-range::-webkit-slider-thumb {
                -webkit-transition: none;
                transition: none
            }
        }

        .form-range::-webkit-slider-thumb:active {
            background-color: #b6d4fe
        }

        .form-range::-webkit-slider-runnable-track {
            width: 100%;
            height: .5rem;
            color: transparent;
            cursor: pointer;
            background-color: var(--bs-tertiary-bg);
            border-color: transparent;
            border-radius: 1rem
        }

        .form-range::-moz-range-thumb {
            width: 1rem;
            height: 1rem;
            background-color: #0d6efd;
            border: 0;
            border-radius: 1rem;
            -moz-transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            -moz-appearance: none;
            appearance: none
        }

        @media (prefers-reduced-motion:reduce) {
            .form-range::-moz-range-thumb {
                -moz-transition: none;
                transition: none
            }
        }

        .form-range::-moz-range-thumb:active {
            background-color: #b6d4fe
        }

        .form-range::-moz-range-track {
            width: 100%;
            height: .5rem;
            color: transparent;
            cursor: pointer;
            background-color: var(--bs-tertiary-bg);
            border-color: transparent;
            border-radius: 1rem
        }

        .form-range:disabled {
            pointer-events: none
        }

        .form-range:disabled::-webkit-slider-thumb {
            background-color: var(--bs-secondary-color)
        }

        .form-range:disabled::-moz-range-thumb {
            background-color: var(--bs-secondary-color)
        }

        .form-floating {
            position: relative
        }

        .form-floating>.form-control,
        .form-floating>.form-control-plaintext,
        .form-floating>.form-select {
            height: calc(3.5rem + calc(var(--bs-border-width) * 2));
            min-height: calc(3.5rem + calc(var(--bs-border-width) * 2));
            line-height: 1.25
        }

        .form-floating>label {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 2;
            height: 100%;
            padding: 1rem .75rem;
            overflow: hidden;
            text-align: start;
            text-overflow: ellipsis;
            white-space: nowrap;
            pointer-events: none;
            border: var(--bs-border-width) solid transparent;
            transform-origin: 0 0;
            transition: opacity .1s ease-in-out, transform .1s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .form-floating>label {
                transition: none
            }
        }

        .form-floating>.form-control,
        .form-floating>.form-control-plaintext {
            padding: 1rem .75rem
        }

        .form-floating>.form-control-plaintext::-moz-placeholder,
        .form-floating>.form-control::-moz-placeholder {
            color: transparent
        }

        .form-floating>.form-control-plaintext::placeholder,
        .form-floating>.form-control::placeholder {
            color: transparent
        }

        .form-floating>.form-control-plaintext:not(:-moz-placeholder-shown),
        .form-floating>.form-control:not(:-moz-placeholder-shown) {
            padding-top: 1.625rem;
            padding-bottom: .625rem
        }

        .form-floating>.form-control-plaintext:focus,
        .form-floating>.form-control-plaintext:not(:placeholder-shown),
        .form-floating>.form-control:focus,
        .form-floating>.form-control:not(:placeholder-shown) {
            padding-top: 1.625rem;
            padding-bottom: .625rem
        }

        .form-floating>.form-control-plaintext:-webkit-autofill,
        .form-floating>.form-control:-webkit-autofill {
            padding-top: 1.625rem;
            padding-bottom: .625rem
        }

        .form-floating>.form-select {
            padding-top: 1.625rem;
            padding-bottom: .625rem
        }

        .form-floating>.form-control:not(:-moz-placeholder-shown)~label {
            color: rgba(var(--bs-body-color-rgb), .65);
            transform: scale(.85) translateY(-.5rem) translateX(.15rem)
        }

        .form-floating>.form-control-plaintext~label,
        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label,
        .form-floating>.form-select~label {
            color: rgba(var(--bs-body-color-rgb), .65);
            transform: scale(.85) translateY(-.5rem) translateX(.15rem)
        }

        .form-floating>.form-control:not(:-moz-placeholder-shown)~label::after {
            position: absolute;
            inset: 1rem 0.375rem;
            z-index: -1;
            height: 1.5em;
            content: "";
            background-color: var(--bs-body-bg);
            border-radius: var(--bs-border-radius)
        }

        .form-floating>.form-control-plaintext~label::after,
        .form-floating>.form-control:focus~label::after,
        .form-floating>.form-control:not(:placeholder-shown)~label::after,
        .form-floating>.form-select~label::after {
            position: absolute;
            inset: 1rem 0.375rem;
            z-index: -1;
            height: 1.5em;
            content: "";
            background-color: var(--bs-body-bg);
            border-radius: var(--bs-border-radius)
        }

        .form-floating>.form-control:-webkit-autofill~label {
            color: rgba(var(--bs-body-color-rgb), .65);
            transform: scale(.85) translateY(-.5rem) translateX(.15rem)
        }

        .form-floating>.form-control-plaintext~label {
            border-width: var(--bs-border-width) 0
        }

        .form-floating>:disabled~label {
            color: #6c757d
        }

        .form-floating>:disabled~label::after {
            background-color: var(--bs-secondary-bg)
        }

        .input-group {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 100%
        }

        .input-group>.form-control,
        .input-group>.form-floating,
        .input-group>.form-select {
            position: relative;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0
        }

        .input-group>.form-control:focus,
        .input-group>.form-floating:focus-within,
        .input-group>.form-select:focus {
            z-index: 5
        }

        .input-group .btn {
            position: relative;
            z-index: 2
        }

        .input-group .btn:focus {
            z-index: 5
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--bs-body-color);
            text-align: center;
            white-space: nowrap;
            background-color: var(--bs-tertiary-bg);
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius)
        }

        .input-group-lg>.btn,
        .input-group-lg>.form-control,
        .input-group-lg>.form-select,
        .input-group-lg>.input-group-text {
            padding: .5rem 1rem;
            font-size: 1.25rem;
            border-radius: var(--bs-border-radius-lg)
        }

        .input-group-sm>.btn,
        .input-group-sm>.form-control,
        .input-group-sm>.form-select,
        .input-group-sm>.input-group-text {
            padding: .25rem .5rem;
            font-size: .875rem;
            border-radius: var(--bs-border-radius-sm)
        }

        .input-group-lg>.form-select,
        .input-group-sm>.form-select {
            padding-right: 3rem
        }

        .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3),
        .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-control,
        .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-select,
        .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0
        }

        .input-group.has-validation>.dropdown-toggle:nth-last-child(n+4),
        .input-group.has-validation>.form-floating:nth-last-child(n+3)>.form-control,
        .input-group.has-validation>.form-floating:nth-last-child(n+3)>.form-select,
        .input-group.has-validation>:nth-last-child(n+3):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0
        }

        .input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            margin-left: calc(var(--bs-border-width) * -1);
            border-top-left-radius: 0;
            border-bottom-left-radius: 0
        }

        .input-group>.form-floating:not(:first-child)>.form-control,
        .input-group>.form-floating:not(:first-child)>.form-select {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0
        }

        .valid-feedback {
            display: none;
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: var(--bs-form-valid-color)
        }

        .valid-tooltip {
            position: absolute;
            top: 100%;
            z-index: 5;
            display: none;
            max-width: 100%;
            padding: .25rem .5rem;
            margin-top: .1rem;
            font-size: .875rem;
            color: #fff;
            background-color: var(--bs-success);
            border-radius: var(--bs-border-radius)
        }

        .is-valid~.valid-feedback,
        .is-valid~.valid-tooltip,
        .was-validated :valid~.valid-feedback,
        .was-validated :valid~.valid-tooltip {
            display: block
        }

        .form-control.is-valid,
        .was-validated .form-control:valid {
            border-color: var(--bs-form-valid-border-color);
            padding-right: calc(1.5em + .75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(.375em + .1875rem) center;
            background-size: calc(.75em + .375rem) calc(.75em + .375rem)
        }

        .form-control.is-valid:focus,
        .was-validated .form-control:valid:focus {
            border-color: var(--bs-form-valid-border-color);
            box-shadow: 0 0 0 .25rem rgba(var(--bs-success-rgb), .25)
        }

        .was-validated textarea.form-control:valid,
        textarea.form-control.is-valid {
            padding-right: calc(1.5em + .75rem);
            background-position: top calc(.375em + .1875rem) right calc(.375em + .1875rem)
        }

        .form-select.is-valid,
        .was-validated .form-select:valid {
            border-color: var(--bs-form-valid-border-color)
        }

        .form-select.is-valid:not([multiple]):not([size]),
        .form-select.is-valid:not([multiple])[size="1"],
        .was-validated .form-select:valid:not([multiple]):not([size]),
        .was-validated .form-select:valid:not([multiple])[size="1"] {
            --bs-form-select-bg-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            padding-right: 4.125rem;
            background-position: right .75rem center, center right 2.25rem;
            background-size: 16px 12px, calc(.75em + .375rem) calc(.75em + .375rem)
        }

        .form-select.is-valid:focus,
        .was-validated .form-select:valid:focus {
            border-color: var(--bs-form-valid-border-color);
            box-shadow: 0 0 0 .25rem rgba(var(--bs-success-rgb), .25)
        }

        .form-control-color.is-valid,
        .was-validated .form-control-color:valid {
            width: calc(3rem + calc(1.5em + .75rem))
        }

        .form-check-input.is-valid,
        .was-validated .form-check-input:valid {
            border-color: var(--bs-form-valid-border-color)
        }

        .form-check-input.is-valid:checked,
        .was-validated .form-check-input:valid:checked {
            background-color: var(--bs-form-valid-color)
        }

        .form-check-input.is-valid:focus,
        .was-validated .form-check-input:valid:focus {
            box-shadow: 0 0 0 .25rem rgba(var(--bs-success-rgb), .25)
        }

        .form-check-input.is-valid~.form-check-label,
        .was-validated .form-check-input:valid~.form-check-label {
            color: var(--bs-form-valid-color)
        }

        .form-check-inline .form-check-input~.valid-feedback {
            margin-left: .5em
        }

        .input-group>.form-control:not(:focus).is-valid,
        .input-group>.form-floating:not(:focus-within).is-valid,
        .input-group>.form-select:not(:focus).is-valid,
        .was-validated .input-group>.form-control:not(:focus):valid,
        .was-validated .input-group>.form-floating:not(:focus-within):valid,
        .was-validated .input-group>.form-select:not(:focus):valid {
            z-index: 3
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: var(--bs-form-invalid-color)
        }

        .invalid-tooltip {
            position: absolute;
            top: 100%;
            z-index: 5;
            display: none;
            max-width: 100%;
            padding: .25rem .5rem;
            margin-top: .1rem;
            font-size: .875rem;
            color: #fff;
            background-color: var(--bs-danger);
            border-radius: var(--bs-border-radius)
        }

        .is-invalid~.invalid-feedback,
        .is-invalid~.invalid-tooltip,
        .was-validated :invalid~.invalid-feedback,
        .was-validated :invalid~.invalid-tooltip {
            display: block
        }

        .form-control.is-invalid,
        .was-validated .form-control:invalid {
            border-color: var(--bs-form-invalid-border-color);
            padding-right: calc(1.5em + .75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(.375em + .1875rem) center;
            background-size: calc(.75em + .375rem) calc(.75em + .375rem)
        }

        .form-control.is-invalid:focus,
        .was-validated .form-control:invalid:focus {
            border-color: var(--bs-form-invalid-border-color);
            box-shadow: 0 0 0 .25rem rgba(var(--bs-danger-rgb), .25)
        }

        .was-validated textarea.form-control:invalid,
        textarea.form-control.is-invalid {
            padding-right: calc(1.5em + .75rem);
            background-position: top calc(.375em + .1875rem) right calc(.375em + .1875rem)
        }

        .form-select.is-invalid,
        .was-validated .form-select:invalid {
            border-color: var(--bs-form-invalid-border-color)
        }

        .form-select.is-invalid:not([multiple]):not([size]),
        .form-select.is-invalid:not([multiple])[size="1"],
        .was-validated .form-select:invalid:not([multiple]):not([size]),
        .was-validated .form-select:invalid:not([multiple])[size="1"] {
            --bs-form-select-bg-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            padding-right: 4.125rem;
            background-position: right .75rem center, center right 2.25rem;
            background-size: 16px 12px, calc(.75em + .375rem) calc(.75em + .375rem)
        }

        .form-select.is-invalid:focus,
        .was-validated .form-select:invalid:focus {
            border-color: var(--bs-form-invalid-border-color);
            box-shadow: 0 0 0 .25rem rgba(var(--bs-danger-rgb), .25)
        }

        .form-control-color.is-invalid,
        .was-validated .form-control-color:invalid {
            width: calc(3rem + calc(1.5em + .75rem))
        }

        .form-check-input.is-invalid,
        .was-validated .form-check-input:invalid {
            border-color: var(--bs-form-invalid-border-color)
        }

        .form-check-input.is-invalid:checked,
        .was-validated .form-check-input:invalid:checked {
            background-color: var(--bs-form-invalid-color)
        }

        .form-check-input.is-invalid:focus,
        .was-validated .form-check-input:invalid:focus {
            box-shadow: 0 0 0 .25rem rgba(var(--bs-danger-rgb), .25)
        }

        .form-check-input.is-invalid~.form-check-label,
        .was-validated .form-check-input:invalid~.form-check-label {
            color: var(--bs-form-invalid-color)
        }

        .form-check-inline .form-check-input~.invalid-feedback {
            margin-left: .5em
        }

        .input-group>.form-control:not(:focus).is-invalid,
        .input-group>.form-floating:not(:focus-within).is-invalid,
        .input-group>.form-select:not(:focus).is-invalid,
        .was-validated .input-group>.form-control:not(:focus):invalid,
        .was-validated .input-group>.form-floating:not(:focus-within):invalid,
        .was-validated .input-group>.form-select:not(:focus):invalid {
            z-index: 4
        }

        .btn {
            --bs-btn-padding-x: 0.75rem;
            --bs-btn-padding-y: 0.375rem;
            --bs-btn-font-family: ;
            --bs-btn-font-size: 1rem;
            --bs-btn-font-weight: 400;
            --bs-btn-line-height: 1.5;
            --bs-btn-color: var(--bs-body-color);
            --bs-btn-bg: transparent;
            --bs-btn-border-width: var(--bs-border-width);
            --bs-btn-border-color: transparent;
            --bs-btn-border-radius: var(--bs-border-radius);
            --bs-btn-hover-border-color: transparent;
            --bs-btn-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(0, 0, 0, 0.075);
            --bs-btn-disabled-opacity: 0.65;
            --bs-btn-focus-box-shadow: 0 0 0 0.25rem rgba(var(--bs-btn-focus-shadow-rgb), .5);
            display: inline-block;
            padding: var(--bs-btn-padding-y) var(--bs-btn-padding-x);
            font-family: var(--bs-btn-font-family);
            font-size: var(--bs-btn-font-size);
            font-weight: var(--bs-btn-font-weight);
            line-height: var(--bs-btn-line-height);
            color: var(--bs-btn-color);
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            border: var(--bs-btn-border-width) solid var(--bs-btn-border-color);
            border-radius: var(--bs-btn-border-radius);
            background-color: var(--bs-btn-bg);
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .btn {
                transition: none
            }
        }

        .btn:hover {
            color: var(--bs-btn-hover-color);
            background-color: var(--bs-btn-hover-bg);
            border-color: var(--bs-btn-hover-border-color)
        }

        .btn-check+.btn:hover {
            color: var(--bs-btn-color);
            background-color: var(--bs-btn-bg);
            border-color: var(--bs-btn-border-color)
        }

        .btn:focus-visible {
            color: var(--bs-btn-hover-color);
            background-color: var(--bs-btn-hover-bg);
            border-color: var(--bs-btn-hover-border-color);
            outline: 0;
            box-shadow: var(--bs-btn-focus-box-shadow)
        }

        .btn-check:focus-visible+.btn {
            border-color: var(--bs-btn-hover-border-color);
            outline: 0;
            box-shadow: var(--bs-btn-focus-box-shadow)
        }

        .btn-check:checked+.btn,
        .btn.active,
        .btn.show,
        .btn:first-child:active,
        :not(.btn-check)+.btn:active {
            color: var(--bs-btn-active-color);
            background-color: var(--bs-btn-active-bg);
            border-color: var(--bs-btn-active-border-color)
        }

        .btn-check:checked+.btn:focus-visible,
        .btn.active:focus-visible,
        .btn.show:focus-visible,
        .btn:first-child:active:focus-visible,
        :not(.btn-check)+.btn:active:focus-visible {
            box-shadow: var(--bs-btn-focus-box-shadow)
        }

        .btn.disabled,
        .btn:disabled,
        fieldset:disabled .btn {
            color: var(--bs-btn-disabled-color);
            pointer-events: none;
            background-color: var(--bs-btn-disabled-bg);
            border-color: var(--bs-btn-disabled-border-color);
            opacity: var(--bs-btn-disabled-opacity)
        }

        .btn-primary {
            --bs-btn-color: #fff;
            --bs-btn-bg: #0d6efd;
            --bs-btn-border-color: #0d6efd;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #0b5ed7;
            --bs-btn-hover-border-color: #0a58ca;
            --bs-btn-focus-shadow-rgb: 49, 132, 253;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #0a58ca;
            --bs-btn-active-border-color: #0a53be;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #0d6efd;
            --bs-btn-disabled-border-color: #0d6efd
        }

        .btn-secondary {
            --bs-btn-color: #fff;
            --bs-btn-bg: #6c757d;
            --bs-btn-border-color: #6c757d;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #5c636a;
            --bs-btn-hover-border-color: #565e64;
            --bs-btn-focus-shadow-rgb: 130, 138, 145;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #565e64;
            --bs-btn-active-border-color: #51585e;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #6c757d;
            --bs-btn-disabled-border-color: #6c757d
        }

        .btn-success {
            --bs-btn-color: #fff;
            --bs-btn-bg: #198754;
            --bs-btn-border-color: #198754;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #157347;
            --bs-btn-hover-border-color: #146c43;
            --bs-btn-focus-shadow-rgb: 60, 153, 110;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #146c43;
            --bs-btn-active-border-color: #13653f;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #198754;
            --bs-btn-disabled-border-color: #198754
        }

        .btn-info {
            --bs-btn-color: #000;
            --bs-btn-bg: #0dcaf0;
            --bs-btn-border-color: #0dcaf0;
            --bs-btn-hover-color: #000;
            --bs-btn-hover-bg: #31d2f2;
            --bs-btn-hover-border-color: #25cff2;
            --bs-btn-focus-shadow-rgb: 11, 172, 204;
            --bs-btn-active-color: #000;
            --bs-btn-active-bg: #3dd5f3;
            --bs-btn-active-border-color: #25cff2;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #000;
            --bs-btn-disabled-bg: #0dcaf0;
            --bs-btn-disabled-border-color: #0dcaf0
        }

        .btn-warning {
            --bs-btn-color: #000;
            --bs-btn-bg: #ffc107;
            --bs-btn-border-color: #ffc107;
            --bs-btn-hover-color: #000;
            --bs-btn-hover-bg: #ffca2c;
            --bs-btn-hover-border-color: #ffc720;
            --bs-btn-focus-shadow-rgb: 217, 164, 6;
            --bs-btn-active-color: #000;
            --bs-btn-active-bg: #ffcd39;
            --bs-btn-active-border-color: #ffc720;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #000;
            --bs-btn-disabled-bg: #ffc107;
            --bs-btn-disabled-border-color: #ffc107
        }

        .btn-danger {
            --bs-btn-color: #fff;
            --bs-btn-bg: #dc3545;
            --bs-btn-border-color: #dc3545;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #bb2d3b;
            --bs-btn-hover-border-color: #b02a37;
            --bs-btn-focus-shadow-rgb: 225, 83, 97;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #b02a37;
            --bs-btn-active-border-color: #a52834;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #dc3545;
            --bs-btn-disabled-border-color: #dc3545
        }

        .btn-light {
            --bs-btn-color: #000;
            --bs-btn-bg: #f8f9fa;
            --bs-btn-border-color: #f8f9fa;
            --bs-btn-hover-color: #000;
            --bs-btn-hover-bg: #d3d4d5;
            --bs-btn-hover-border-color: #c6c7c8;
            --bs-btn-focus-shadow-rgb: 211, 212, 213;
            --bs-btn-active-color: #000;
            --bs-btn-active-bg: #c6c7c8;
            --bs-btn-active-border-color: #babbbc;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #000;
            --bs-btn-disabled-bg: #f8f9fa;
            --bs-btn-disabled-border-color: #f8f9fa
        }

        .btn-dark {
            --bs-btn-color: #fff;
            --bs-btn-bg: #212529;
            --bs-btn-border-color: #212529;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #424649;
            --bs-btn-hover-border-color: #373b3e;
            --bs-btn-focus-shadow-rgb: 66, 70, 73;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #4d5154;
            --bs-btn-active-border-color: #373b3e;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #212529;
            --bs-btn-disabled-border-color: #212529
        }

        .btn-outline-primary {
            --bs-btn-color: #0d6efd;
            --bs-btn-border-color: #0d6efd;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #0d6efd;
            --bs-btn-hover-border-color: #0d6efd;
            --bs-btn-focus-shadow-rgb: 13, 110, 253;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #0d6efd;
            --bs-btn-active-border-color: #0d6efd;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #0d6efd;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #0d6efd;
            --bs-gradient: none
        }

        .btn-outline-secondary {
            --bs-btn-color: #6c757d;
            --bs-btn-border-color: #6c757d;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #6c757d;
            --bs-btn-hover-border-color: #6c757d;
            --bs-btn-focus-shadow-rgb: 108, 117, 125;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #6c757d;
            --bs-btn-active-border-color: #6c757d;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #6c757d;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #6c757d;
            --bs-gradient: none
        }

        .btn-outline-success {
            --bs-btn-color: #198754;
            --bs-btn-border-color: #198754;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #198754;
            --bs-btn-hover-border-color: #198754;
            --bs-btn-focus-shadow-rgb: 25, 135, 84;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #198754;
            --bs-btn-active-border-color: #198754;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #198754;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #198754;
            --bs-gradient: none
        }

        .btn-outline-info {
            --bs-btn-color: #0dcaf0;
            --bs-btn-border-color: #0dcaf0;
            --bs-btn-hover-color: #000;
            --bs-btn-hover-bg: #0dcaf0;
            --bs-btn-hover-border-color: #0dcaf0;
            --bs-btn-focus-shadow-rgb: 13, 202, 240;
            --bs-btn-active-color: #000;
            --bs-btn-active-bg: #0dcaf0;
            --bs-btn-active-border-color: #0dcaf0;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #0dcaf0;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #0dcaf0;
            --bs-gradient: none
        }

        .btn-outline-warning {
            --bs-btn-color: #ffc107;
            --bs-btn-border-color: #ffc107;
            --bs-btn-hover-color: #000;
            --bs-btn-hover-bg: #ffc107;
            --bs-btn-hover-border-color: #ffc107;
            --bs-btn-focus-shadow-rgb: 255, 193, 7;
            --bs-btn-active-color: #000;
            --bs-btn-active-bg: #ffc107;
            --bs-btn-active-border-color: #ffc107;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #ffc107;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #ffc107;
            --bs-gradient: none
        }

        .btn-outline-danger {
            --bs-btn-color: #dc3545;
            --bs-btn-border-color: #dc3545;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #dc3545;
            --bs-btn-hover-border-color: #dc3545;
            --bs-btn-focus-shadow-rgb: 220, 53, 69;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #dc3545;
            --bs-btn-active-border-color: #dc3545;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #dc3545;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #dc3545;
            --bs-gradient: none
        }

        .btn-outline-light {
            --bs-btn-color: #f8f9fa;
            --bs-btn-border-color: #f8f9fa;
            --bs-btn-hover-color: #000;
            --bs-btn-hover-bg: #f8f9fa;
            --bs-btn-hover-border-color: #f8f9fa;
            --bs-btn-focus-shadow-rgb: 248, 249, 250;
            --bs-btn-active-color: #000;
            --bs-btn-active-bg: #f8f9fa;
            --bs-btn-active-border-color: #f8f9fa;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #f8f9fa;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #f8f9fa;
            --bs-gradient: none
        }

        .btn-outline-dark {
            --bs-btn-color: #212529;
            --bs-btn-border-color: #212529;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #212529;
            --bs-btn-hover-border-color: #212529;
            --bs-btn-focus-shadow-rgb: 33, 37, 41;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #212529;
            --bs-btn-active-border-color: #212529;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #212529;
            --bs-btn-disabled-bg: transparent;
            --bs-btn-disabled-border-color: #212529;
            --bs-gradient: none
        }

        .btn-link {
            --bs-btn-font-weight: 400;
            --bs-btn-color: var(--bs-link-color);
            --bs-btn-bg: transparent;
            --bs-btn-border-color: transparent;
            --bs-btn-hover-color: var(--bs-link-hover-color);
            --bs-btn-hover-border-color: transparent;
            --bs-btn-active-color: var(--bs-link-hover-color);
            --bs-btn-active-border-color: transparent;
            --bs-btn-disabled-color: #6c757d;
            --bs-btn-disabled-border-color: transparent;
            --bs-btn-box-shadow: 0 0 0 #000;
            --bs-btn-focus-shadow-rgb: 49, 132, 253;
            text-decoration: underline
        }

        .btn-link:focus-visible {
            color: var(--bs-btn-color)
        }

        .btn-link:hover {
            color: var(--bs-btn-hover-color)
        }

        .btn-group-lg>.btn,
        .btn-lg {
            --bs-btn-padding-y: 0.5rem;
            --bs-btn-padding-x: 1rem;
            --bs-btn-font-size: 1.25rem;
            --bs-btn-border-radius: var(--bs-border-radius-lg)
        }

        .btn-group-sm>.btn,
        .btn-sm {
            --bs-btn-padding-y: 0.25rem;
            --bs-btn-padding-x: 0.5rem;
            --bs-btn-font-size: 0.875rem;
            --bs-btn-border-radius: var(--bs-border-radius-sm)
        }

        .fade {
            transition: opacity .15s linear
        }

        @media (prefers-reduced-motion:reduce) {
            .fade {
                transition: none
            }
        }

        .fade:not(.show) {
            opacity: 0
        }

        .collapse:not(.show) {
            display: none
        }

        .collapsing {
            height: 0;
            overflow: hidden;
            transition: height .35s ease
        }

        @media (prefers-reduced-motion:reduce) {
            .collapsing {
                transition: none
            }
        }

        .collapsing.collapse-horizontal {
            width: 0;
            height: auto;
            transition: width .35s ease
        }

        @media (prefers-reduced-motion:reduce) {
            .collapsing.collapse-horizontal {
                transition: none
            }
        }

        .dropdown,
        .dropdown-center,
        .dropend,
        .dropstart,
        .dropup,
        .dropup-center {
            position: relative
        }

        .dropdown-toggle {
            white-space: nowrap
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent
        }

        .dropdown-toggle:empty::after {
            margin-left: 0
        }

        .dropdown-menu {
            --bs-dropdown-zindex: 1000;
            --bs-dropdown-min-width: 10rem;
            --bs-dropdown-padding-x: 0;
            --bs-dropdown-padding-y: 0.5rem;
            --bs-dropdown-spacer: 0.125rem;
            --bs-dropdown-font-size: 1rem;
            --bs-dropdown-color: var(--bs-body-color);
            --bs-dropdown-bg: var(--bs-body-bg);
            --bs-dropdown-border-color: var(--bs-border-color-translucent);
            --bs-dropdown-border-radius: var(--bs-border-radius);
            --bs-dropdown-border-width: var(--bs-border-width);
            --bs-dropdown-inner-border-radius: calc(var(--bs-border-radius) - var(--bs-border-width));
            --bs-dropdown-divider-bg: var(--bs-border-color-translucent);
            --bs-dropdown-divider-margin-y: 0.5rem;
            --bs-dropdown-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            --bs-dropdown-link-color: var(--bs-body-color);
            --bs-dropdown-link-hover-color: var(--bs-body-color);
            --bs-dropdown-link-hover-bg: var(--bs-tertiary-bg);
            --bs-dropdown-link-active-color: #fff;
            --bs-dropdown-link-active-bg: #0d6efd;
            --bs-dropdown-link-disabled-color: var(--bs-tertiary-color);
            --bs-dropdown-item-padding-x: 1rem;
            --bs-dropdown-item-padding-y: 0.25rem;
            --bs-dropdown-header-color: #6c757d;
            --bs-dropdown-header-padding-x: 1rem;
            --bs-dropdown-header-padding-y: 0.5rem;
            position: absolute;
            z-index: var(--bs-dropdown-zindex);
            display: none;
            min-width: var(--bs-dropdown-min-width);
            padding: var(--bs-dropdown-padding-y) var(--bs-dropdown-padding-x);
            margin: 0;
            font-size: var(--bs-dropdown-font-size);
            color: var(--bs-dropdown-color);
            text-align: left;
            list-style: none;
            background-color: var(--bs-dropdown-bg);
            background-clip: padding-box;
            border: var(--bs-dropdown-border-width) solid var(--bs-dropdown-border-color);
            border-radius: var(--bs-dropdown-border-radius)
        }

        .dropdown-menu[data-bs-popper] {
            top: 100%;
            left: 0;
            margin-top: var(--bs-dropdown-spacer)
        }

        .dropdown-menu-start {
            --bs-position: start
        }

        .dropdown-menu-start[data-bs-popper] {
            right: auto;
            left: 0
        }

        .dropdown-menu-end {
            --bs-position: end
        }

        .dropdown-menu-end[data-bs-popper] {
            right: 0;
            left: auto
        }

        @media (min-width:576px) {
            .dropdown-menu-sm-start {
                --bs-position: start
            }

            .dropdown-menu-sm-start[data-bs-popper] {
                right: auto;
                left: 0
            }

            .dropdown-menu-sm-end {
                --bs-position: end
            }

            .dropdown-menu-sm-end[data-bs-popper] {
                right: 0;
                left: auto
            }
        }

        @media (min-width:768px) {
            .dropdown-menu-md-start {
                --bs-position: start
            }

            .dropdown-menu-md-start[data-bs-popper] {
                right: auto;
                left: 0
            }

            .dropdown-menu-md-end {
                --bs-position: end
            }

            .dropdown-menu-md-end[data-bs-popper] {
                right: 0;
                left: auto
            }
        }

        @media (min-width:992px) {
            .dropdown-menu-lg-start {
                --bs-position: start
            }

            .dropdown-menu-lg-start[data-bs-popper] {
                right: auto;
                left: 0
            }

            .dropdown-menu-lg-end {
                --bs-position: end
            }

            .dropdown-menu-lg-end[data-bs-popper] {
                right: 0;
                left: auto
            }
        }

        @media (min-width:1200px) {
            .dropdown-menu-xl-start {
                --bs-position: start
            }

            .dropdown-menu-xl-start[data-bs-popper] {
                right: auto;
                left: 0
            }

            .dropdown-menu-xl-end {
                --bs-position: end
            }

            .dropdown-menu-xl-end[data-bs-popper] {
                right: 0;
                left: auto
            }
        }

        @media (min-width:1400px) {
            .dropdown-menu-xxl-start {
                --bs-position: start
            }

            .dropdown-menu-xxl-start[data-bs-popper] {
                right: auto;
                left: 0
            }

            .dropdown-menu-xxl-end {
                --bs-position: end
            }

            .dropdown-menu-xxl-end[data-bs-popper] {
                right: 0;
                left: auto
            }
        }

        .dropup .dropdown-menu[data-bs-popper] {
            top: auto;
            bottom: 100%;
            margin-top: 0;
            margin-bottom: var(--bs-dropdown-spacer)
        }

        .dropup .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: 0;
            border-right: .3em solid transparent;
            border-bottom: .3em solid;
            border-left: .3em solid transparent
        }

        .dropup .dropdown-toggle:empty::after {
            margin-left: 0
        }

        .dropend .dropdown-menu[data-bs-popper] {
            top: 0;
            right: auto;
            left: 100%;
            margin-top: 0;
            margin-left: var(--bs-dropdown-spacer)
        }

        .dropend .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid transparent;
            border-right: 0;
            border-bottom: .3em solid transparent;
            border-left: .3em solid
        }

        .dropend .dropdown-toggle:empty::after {
            margin-left: 0
        }

        .dropend .dropdown-toggle::after {
            vertical-align: 0
        }

        .dropstart .dropdown-menu[data-bs-popper] {
            top: 0;
            right: 100%;
            left: auto;
            margin-top: 0;
            margin-right: var(--bs-dropdown-spacer)
        }

        .dropstart .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: ""
        }

        .dropstart .dropdown-toggle::after {
            display: none
        }

        .dropstart .dropdown-toggle::before {
            display: inline-block;
            margin-right: .255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid transparent;
            border-right: .3em solid;
            border-bottom: .3em solid transparent
        }

        .dropstart .dropdown-toggle:empty::after {
            margin-left: 0
        }

        .dropstart .dropdown-toggle::before {
            vertical-align: 0
        }

        .dropdown-divider {
            height: 0;
            margin: var(--bs-dropdown-divider-margin-y) 0;
            overflow: hidden;
            border-top: 1px solid var(--bs-dropdown-divider-bg);
            opacity: 1
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: var(--bs-dropdown-item-padding-y) var(--bs-dropdown-item-padding-x);
            clear: both;
            font-weight: 400;
            color: var(--bs-dropdown-link-color);
            text-align: inherit;
            text-decoration: none;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
            border-radius: var(--bs-dropdown-item-border-radius, 0)
        }

        .dropdown-item:focus,
        .dropdown-item:hover {
            color: var(--bs-dropdown-link-hover-color);
            background-color: var(--bs-dropdown-link-hover-bg)
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: var(--bs-dropdown-link-active-color);
            text-decoration: none;
            background-color: var(--bs-dropdown-link-active-bg)
        }

        .dropdown-item.disabled,
        .dropdown-item:disabled {
            color: var(--bs-dropdown-link-disabled-color);
            pointer-events: none;
            background-color: transparent
        }

        .dropdown-menu.show {
            display: block
        }

        .dropdown-header {
            display: block;
            padding: var(--bs-dropdown-header-padding-y) var(--bs-dropdown-header-padding-x);
            margin-bottom: 0;
            font-size: .875rem;
            color: var(--bs-dropdown-header-color);
            white-space: nowrap
        }

        .dropdown-item-text {
            display: block;
            padding: var(--bs-dropdown-item-padding-y) var(--bs-dropdown-item-padding-x);
            color: var(--bs-dropdown-link-color)
        }

        .dropdown-menu-dark {
            --bs-dropdown-color: #dee2e6;
            --bs-dropdown-bg: #343a40;
            --bs-dropdown-border-color: var(--bs-border-color-translucent);
            --bs-dropdown-box-shadow: ;
            --bs-dropdown-link-color: #dee2e6;
            --bs-dropdown-link-hover-color: #fff;
            --bs-dropdown-divider-bg: var(--bs-border-color-translucent);
            --bs-dropdown-link-hover-bg: rgba(255, 255, 255, 0.15);
            --bs-dropdown-link-active-color: #fff;
            --bs-dropdown-link-active-bg: #0d6efd;
            --bs-dropdown-link-disabled-color: #adb5bd;
            --bs-dropdown-header-color: #adb5bd
        }

        .btn-group,
        .btn-group-vertical {
            position: relative;
            display: inline-flex;
            vertical-align: middle
        }

        .btn-group-vertical>.btn,
        .btn-group>.btn {
            position: relative;
            flex: 1 1 auto
        }

        .btn-group-vertical>.btn-check:checked+.btn,
        .btn-group-vertical>.btn-check:focus+.btn,
        .btn-group-vertical>.btn.active,
        .btn-group-vertical>.btn:active,
        .btn-group-vertical>.btn:focus,
        .btn-group-vertical>.btn:hover,
        .btn-group>.btn-check:checked+.btn,
        .btn-group>.btn-check:focus+.btn,
        .btn-group>.btn.active,
        .btn-group>.btn:active,
        .btn-group>.btn:focus,
        .btn-group>.btn:hover {
            z-index: 1
        }

        .btn-toolbar {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start
        }

        .btn-toolbar .input-group {
            width: auto
        }

        .btn-group {
            border-radius: var(--bs-border-radius)
        }

        .btn-group>.btn-group:not(:first-child),
        .btn-group>:not(.btn-check:first-child)+.btn {
            margin-left: calc(var(--bs-border-width) * -1)
        }

        .btn-group>.btn-group:not(:last-child)>.btn,
        .btn-group>.btn.dropdown-toggle-split:first-child,
        .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0
        }

        .btn-group>.btn-group:not(:first-child)>.btn,
        .btn-group>.btn:nth-child(n+3),
        .btn-group>:not(.btn-check)+.btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0
        }

        .dropdown-toggle-split {
            padding-right: .5625rem;
            padding-left: .5625rem
        }

        .dropdown-toggle-split::after,
        .dropend .dropdown-toggle-split::after,
        .dropup .dropdown-toggle-split::after {
            margin-left: 0
        }

        .dropstart .dropdown-toggle-split::before {
            margin-right: 0
        }

        .btn-group-sm>.btn+.dropdown-toggle-split,
        .btn-sm+.dropdown-toggle-split {
            padding-right: .375rem;
            padding-left: .375rem
        }

        .btn-group-lg>.btn+.dropdown-toggle-split,
        .btn-lg+.dropdown-toggle-split {
            padding-right: .75rem;
            padding-left: .75rem
        }

        .btn-group-vertical {
            flex-direction: column;
            align-items: flex-start;
            justify-content: center
        }

        .btn-group-vertical>.btn,
        .btn-group-vertical>.btn-group {
            width: 100%
        }

        .btn-group-vertical>.btn-group:not(:first-child),
        .btn-group-vertical>.btn:not(:first-child) {
            margin-top: calc(var(--bs-border-width) * -1)
        }

        .btn-group-vertical>.btn-group:not(:last-child)>.btn,
        .btn-group-vertical>.btn:not(:last-child):not(.dropdown-toggle) {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0
        }

        .btn-group-vertical>.btn-group:not(:first-child)>.btn,
        .btn-group-vertical>.btn~.btn {
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .nav {
            --bs-nav-link-padding-x: 1rem;
            --bs-nav-link-padding-y: 0.5rem;
            --bs-nav-link-font-weight: ;
            --bs-nav-link-color: var(--bs-link-color);
            --bs-nav-link-hover-color: var(--bs-link-hover-color);
            --bs-nav-link-disabled-color: var(--bs-secondary-color);
            display: flex;
            flex-wrap: wrap;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none
        }

        .nav-link {
            display: block;
            padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
            font-size: var(--bs-nav-link-font-size);
            font-weight: var(--bs-nav-link-font-weight);
            color: var(--bs-nav-link-color);
            text-decoration: none;
            background: 0 0;
            border: 0;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .nav-link {
                transition: none
            }
        }

        .nav-link:focus,
        .nav-link:hover {
            color: var(--bs-nav-link-hover-color)
        }

        .nav-link:focus-visible {
            outline: 0;
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25)
        }

        .nav-link.disabled {
            color: var(--bs-nav-link-disabled-color);
            pointer-events: none;
            cursor: default
        }

        .nav-tabs {
            --bs-nav-tabs-border-width: var(--bs-border-width);
            --bs-nav-tabs-border-color: var(--bs-border-color);
            --bs-nav-tabs-border-radius: var(--bs-border-radius);
            --bs-nav-tabs-link-hover-border-color: var(--bs-secondary-bg) var(--bs-secondary-bg) var(--bs-border-color);
            --bs-nav-tabs-link-active-color: var(--bs-emphasis-color);
            --bs-nav-tabs-link-active-bg: var(--bs-body-bg);
            --bs-nav-tabs-link-active-border-color: var(--bs-border-color) var(--bs-border-color) var(--bs-body-bg);
            border-bottom: var(--bs-nav-tabs-border-width) solid var(--bs-nav-tabs-border-color)
        }

        .nav-tabs .nav-link {
            margin-bottom: calc(-1 * var(--bs-nav-tabs-border-width));
            border: var(--bs-nav-tabs-border-width) solid transparent;
            border-top-left-radius: var(--bs-nav-tabs-border-radius);
            border-top-right-radius: var(--bs-nav-tabs-border-radius)
        }

        .nav-tabs .nav-link:focus,
        .nav-tabs .nav-link:hover {
            isolation: isolate;
            border-color: var(--bs-nav-tabs-link-hover-border-color)
        }

        .nav-tabs .nav-link.disabled,
        .nav-tabs .nav-link:disabled {
            color: var(--bs-nav-link-disabled-color);
            background-color: transparent;
            border-color: transparent
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: var(--bs-nav-tabs-link-active-color);
            background-color: var(--bs-nav-tabs-link-active-bg);
            border-color: var(--bs-nav-tabs-link-active-border-color)
        }

        .nav-tabs .dropdown-menu {
            margin-top: calc(-1 * var(--bs-nav-tabs-border-width));
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .nav-pills {
            --bs-nav-pills-border-radius: var(--bs-border-radius);
            --bs-nav-pills-link-active-color: #fff;
            --bs-nav-pills-link-active-bg: #0d6efd
        }

        .nav-pills .nav-link {
            border-radius: var(--bs-nav-pills-border-radius)
        }

        .nav-pills .nav-link:disabled {
            color: var(--bs-nav-link-disabled-color);
            background-color: transparent;
            border-color: transparent
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: var(--bs-nav-pills-link-active-color);
            background-color: var(--bs-nav-pills-link-active-bg)
        }

        .nav-underline {
            --bs-nav-underline-gap: 1rem;
            --bs-nav-underline-border-width: 0.125rem;
            --bs-nav-underline-link-active-color: var(--bs-emphasis-color);
            gap: var(--bs-nav-underline-gap)
        }

        .nav-underline .nav-link {
            padding-right: 0;
            padding-left: 0;
            border-bottom: var(--bs-nav-underline-border-width) solid transparent
        }

        .nav-underline .nav-link:focus,
        .nav-underline .nav-link:hover {
            border-bottom-color: currentcolor
        }

        .nav-underline .nav-link.active,
        .nav-underline .show>.nav-link {
            font-weight: 700;
            color: var(--bs-nav-underline-link-active-color);
            border-bottom-color: currentcolor
        }

        .nav-fill .nav-item,
        .nav-fill>.nav-link {
            flex: 1 1 auto;
            text-align: center
        }

        .nav-justified .nav-item,
        .nav-justified>.nav-link {
            flex-basis: 0;
            flex-grow: 1;
            text-align: center
        }

        .nav-fill .nav-item .nav-link,
        .nav-justified .nav-item .nav-link {
            width: 100%
        }

        .tab-content>.tab-pane {
            display: none
        }

        .tab-content>.active {
            display: block
        }

        .navbar {
            --bs-navbar-padding-x: 0;
            --bs-navbar-padding-y: 0.5rem;
            --bs-navbar-color: rgba(var(--bs-emphasis-color-rgb), 0.65);
            --bs-navbar-hover-color: rgba(var(--bs-emphasis-color-rgb), 0.8);
            --bs-navbar-disabled-color: rgba(var(--bs-emphasis-color-rgb), 0.3);
            --bs-navbar-active-color: rgba(var(--bs-emphasis-color-rgb), 1);
            --bs-navbar-brand-padding-y: 0.3125rem;
            --bs-navbar-brand-margin-end: 1rem;
            --bs-navbar-brand-font-size: 1.25rem;
            --bs-navbar-brand-color: rgba(var(--bs-emphasis-color-rgb), 1);
            --bs-navbar-brand-hover-color: rgba(var(--bs-emphasis-color-rgb), 1);
            --bs-navbar-nav-link-padding-x: 0.5rem;
            --bs-navbar-toggler-padding-y: 0.25rem;
            --bs-navbar-toggler-padding-x: 0.75rem;
            --bs-navbar-toggler-font-size: 1.25rem;
            --bs-navbar-toggler-icon-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2833, 37, 41, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            --bs-navbar-toggler-border-color: rgba(var(--bs-emphasis-color-rgb), 0.15);
            --bs-navbar-toggler-border-radius: var(--bs-border-radius);
            --bs-navbar-toggler-focus-width: 0.25rem;
            --bs-navbar-toggler-transition: box-shadow 0.15s ease-in-out;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            padding: var(--bs-navbar-padding-y) var(--bs-navbar-padding-x)
        }

        .navbar>.container,
        .navbar>.container-fluid,
        .navbar>.container-lg,
        .navbar>.container-md,
        .navbar>.container-sm,
        .navbar>.container-xl,
        .navbar>.container-xxl {
            display: flex;
            flex-wrap: inherit;
            align-items: center;
            justify-content: space-between
        }

        .navbar-brand {
            padding-top: var(--bs-navbar-brand-padding-y);
            padding-bottom: var(--bs-navbar-brand-padding-y);
            margin-right: var(--bs-navbar-brand-margin-end);
            font-size: var(--bs-navbar-brand-font-size);
            color: var(--bs-navbar-brand-color);
            text-decoration: none;
            white-space: nowrap
        }

        .navbar-brand:focus,
        .navbar-brand:hover {
            color: var(--bs-navbar-brand-hover-color)
        }

        .navbar-nav {
            --bs-nav-link-padding-x: 0;
            --bs-nav-link-padding-y: 0.5rem;
            --bs-nav-link-font-weight: ;
            --bs-nav-link-color: var(--bs-navbar-color);
            --bs-nav-link-hover-color: var(--bs-navbar-hover-color);
            --bs-nav-link-disabled-color: var(--bs-navbar-disabled-color);
            display: flex;
            flex-direction: column;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link.show {
            color: var(--bs-navbar-active-color)
        }

        .navbar-nav .dropdown-menu {
            position: static
        }

        .navbar-text {
            padding-top: .5rem;
            padding-bottom: .5rem;
            color: var(--bs-navbar-color)
        }

        .navbar-text a,
        .navbar-text a:focus,
        .navbar-text a:hover {
            color: var(--bs-navbar-active-color)
        }

        .navbar-collapse {
            flex-basis: 100%;
            flex-grow: 1;
            align-items: center
        }

        .navbar-toggler {
            padding: var(--bs-navbar-toggler-padding-y) var(--bs-navbar-toggler-padding-x);
            font-size: var(--bs-navbar-toggler-font-size);
            line-height: 1;
            color: var(--bs-navbar-color);
            background-color: transparent;
            border: var(--bs-border-width) solid var(--bs-navbar-toggler-border-color);
            border-radius: var(--bs-navbar-toggler-border-radius);
            transition: var(--bs-navbar-toggler-transition)
        }

        @media (prefers-reduced-motion:reduce) {
            .navbar-toggler {
                transition: none
            }
        }

        .navbar-toggler:hover {
            text-decoration: none
        }

        .navbar-toggler:focus {
            text-decoration: none;
            outline: 0;
            box-shadow: 0 0 0 var(--bs-navbar-toggler-focus-width)
        }

        .navbar-toggler-icon {
            display: inline-block;
            width: 1.5em;
            height: 1.5em;
            vertical-align: middle;
            background-image: var(--bs-navbar-toggler-icon-bg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100%
        }

        .navbar-nav-scroll {
            max-height: var(--bs-scroll-height, 75vh);
            overflow-y: auto
        }

        @media (min-width:576px) {
            .navbar-expand-sm {
                flex-wrap: nowrap;
                justify-content: flex-start
            }

            .navbar-expand-sm .navbar-nav {
                flex-direction: row
            }

            .navbar-expand-sm .navbar-nav .dropdown-menu {
                position: absolute
            }

            .navbar-expand-sm .navbar-nav .nav-link {
                padding-right: var(--bs-navbar-nav-link-padding-x);
                padding-left: var(--bs-navbar-nav-link-padding-x)
            }

            .navbar-expand-sm .navbar-nav-scroll {
                overflow: visible
            }

            .navbar-expand-sm .navbar-collapse {
                display: flex !important;
                flex-basis: auto
            }

            .navbar-expand-sm .navbar-toggler {
                display: none
            }

            .navbar-expand-sm .offcanvas {
                position: static;
                z-index: auto;
                flex-grow: 1;
                width: auto !important;
                height: auto !important;
                visibility: visible !important;
                background-color: transparent !important;
                border: 0 !important;
                transform: none !important;
                transition: none
            }

            .navbar-expand-sm .offcanvas .offcanvas-header {
                display: none
            }

            .navbar-expand-sm .offcanvas .offcanvas-body {
                display: flex;
                flex-grow: 0;
                padding: 0;
                overflow-y: visible
            }
        }

        @media (min-width:768px) {
            .navbar-expand-md {
                flex-wrap: nowrap;
                justify-content: flex-start
            }

            .navbar-expand-md .navbar-nav {
                flex-direction: row
            }

            .navbar-expand-md .navbar-nav .dropdown-menu {
                position: absolute
            }

            .navbar-expand-md .navbar-nav .nav-link {
                padding-right: var(--bs-navbar-nav-link-padding-x);
                padding-left: var(--bs-navbar-nav-link-padding-x)
            }

            .navbar-expand-md .navbar-nav-scroll {
                overflow: visible
            }

            .navbar-expand-md .navbar-collapse {
                display: flex !important;
                flex-basis: auto
            }

            .navbar-expand-md .navbar-toggler {
                display: none
            }

            .navbar-expand-md .offcanvas {
                position: static;
                z-index: auto;
                flex-grow: 1;
                width: auto !important;
                height: auto !important;
                visibility: visible !important;
                background-color: transparent !important;
                border: 0 !important;
                transform: none !important;
                transition: none
            }

            .navbar-expand-md .offcanvas .offcanvas-header {
                display: none
            }

            .navbar-expand-md .offcanvas .offcanvas-body {
                display: flex;
                flex-grow: 0;
                padding: 0;
                overflow-y: visible
            }
        }

        @media (min-width:992px) {
            .navbar-expand-lg {
                flex-wrap: nowrap;
                justify-content: flex-start
            }

            .navbar-expand-lg .navbar-nav {
                flex-direction: row
            }

            .navbar-expand-lg .navbar-nav .dropdown-menu {
                position: absolute
            }

            .navbar-expand-lg .navbar-nav .nav-link {
                padding-right: var(--bs-navbar-nav-link-padding-x);
                padding-left: var(--bs-navbar-nav-link-padding-x)
            }

            .navbar-expand-lg .navbar-nav-scroll {
                overflow: visible
            }

            .navbar-expand-lg .navbar-collapse {
                display: flex !important;
                flex-basis: auto
            }

            .navbar-expand-lg .navbar-toggler {
                display: none
            }

            .navbar-expand-lg .offcanvas {
                position: static;
                z-index: auto;
                flex-grow: 1;
                width: auto !important;
                height: auto !important;
                visibility: visible !important;
                background-color: transparent !important;
                border: 0 !important;
                transform: none !important;
                transition: none
            }

            .navbar-expand-lg .offcanvas .offcanvas-header {
                display: none
            }

            .navbar-expand-lg .offcanvas .offcanvas-body {
                display: flex;
                flex-grow: 0;
                padding: 0;
                overflow-y: visible
            }
        }

        @media (min-width:1200px) {
            .navbar-expand-xl {
                flex-wrap: nowrap;
                justify-content: flex-start
            }

            .navbar-expand-xl .navbar-nav {
                flex-direction: row
            }

            .navbar-expand-xl .navbar-nav .dropdown-menu {
                position: absolute
            }

            .navbar-expand-xl .navbar-nav .nav-link {
                padding-right: var(--bs-navbar-nav-link-padding-x);
                padding-left: var(--bs-navbar-nav-link-padding-x)
            }

            .navbar-expand-xl .navbar-nav-scroll {
                overflow: visible
            }

            .navbar-expand-xl .navbar-collapse {
                display: flex !important;
                flex-basis: auto
            }

            .navbar-expand-xl .navbar-toggler {
                display: none
            }

            .navbar-expand-xl .offcanvas {
                position: static;
                z-index: auto;
                flex-grow: 1;
                width: auto !important;
                height: auto !important;
                visibility: visible !important;
                background-color: transparent !important;
                border: 0 !important;
                transform: none !important;
                transition: none
            }

            .navbar-expand-xl .offcanvas .offcanvas-header {
                display: none
            }

            .navbar-expand-xl .offcanvas .offcanvas-body {
                display: flex;
                flex-grow: 0;
                padding: 0;
                overflow-y: visible
            }
        }

        @media (min-width:1400px) {
            .navbar-expand-xxl {
                flex-wrap: nowrap;
                justify-content: flex-start
            }

            .navbar-expand-xxl .navbar-nav {
                flex-direction: row
            }

            .navbar-expand-xxl .navbar-nav .dropdown-menu {
                position: absolute
            }

            .navbar-expand-xxl .navbar-nav .nav-link {
                padding-right: var(--bs-navbar-nav-link-padding-x);
                padding-left: var(--bs-navbar-nav-link-padding-x)
            }

            .navbar-expand-xxl .navbar-nav-scroll {
                overflow: visible
            }

            .navbar-expand-xxl .navbar-collapse {
                display: flex !important;
                flex-basis: auto
            }

            .navbar-expand-xxl .navbar-toggler {
                display: none
            }

            .navbar-expand-xxl .offcanvas {
                position: static;
                z-index: auto;
                flex-grow: 1;
                width: auto !important;
                height: auto !important;
                visibility: visible !important;
                background-color: transparent !important;
                border: 0 !important;
                transform: none !important;
                transition: none
            }

            .navbar-expand-xxl .offcanvas .offcanvas-header {
                display: none
            }

            .navbar-expand-xxl .offcanvas .offcanvas-body {
                display: flex;
                flex-grow: 0;
                padding: 0;
                overflow-y: visible
            }
        }

        .navbar-expand {
            flex-wrap: nowrap;
            justify-content: flex-start
        }

        .navbar-expand .navbar-nav {
            flex-direction: row
        }

        .navbar-expand .navbar-nav .dropdown-menu {
            position: absolute
        }

        .navbar-expand .navbar-nav .nav-link {
            padding-right: var(--bs-navbar-nav-link-padding-x);
            padding-left: var(--bs-navbar-nav-link-padding-x)
        }

        .navbar-expand .navbar-nav-scroll {
            overflow: visible
        }

        .navbar-expand .navbar-collapse {
            display: flex !important;
            flex-basis: auto
        }

        .navbar-expand .navbar-toggler {
            display: none
        }

        .navbar-expand .offcanvas {
            position: static;
            z-index: auto;
            flex-grow: 1;
            width: auto !important;
            height: auto !important;
            visibility: visible !important;
            background-color: transparent !important;
            border: 0 !important;
            transform: none !important;
            transition: none
        }

        .navbar-expand .offcanvas .offcanvas-header {
            display: none
        }

        .navbar-expand .offcanvas .offcanvas-body {
            display: flex;
            flex-grow: 0;
            padding: 0;
            overflow-y: visible
        }

        .navbar-dark,
        .navbar[data-bs-theme=dark] {
            --bs-navbar-color: rgba(255, 255, 255, 0.55);
            --bs-navbar-hover-color: rgba(255, 255, 255, 0.75);
            --bs-navbar-disabled-color: rgba(255, 255, 255, 0.25);
            --bs-navbar-active-color: #fff;
            --bs-navbar-brand-color: #fff;
            --bs-navbar-brand-hover-color: #fff;
            --bs-navbar-toggler-border-color: rgba(255, 255, 255, 0.1);
            --bs-navbar-toggler-icon-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e")
        }

        [data-bs-theme=dark] .navbar-toggler-icon {
            --bs-navbar-toggler-icon-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e")
        }

        .card {
            --bs-card-spacer-y: 1rem;
            --bs-card-spacer-x: 1rem;
            --bs-card-title-spacer-y: 0.5rem;
            --bs-card-title-color: ;
            --bs-card-subtitle-color: ;
            --bs-card-border-width: var(--bs-border-width);
            --bs-card-border-color: var(--bs-border-color-translucent);
            --bs-card-border-radius: var(--bs-border-radius);
            --bs-card-box-shadow: ;
            --bs-card-inner-border-radius: calc(var(--bs-border-radius) - (var(--bs-border-width)));
            --bs-card-cap-padding-y: 0.5rem;
            --bs-card-cap-padding-x: 1rem;
            --bs-card-cap-bg: rgba(var(--bs-body-color-rgb), 0.03);
            --bs-card-cap-color: ;
            --bs-card-height: ;
            --bs-card-color: ;
            --bs-card-bg: var(--bs-body-bg);
            --bs-card-img-overlay-padding: 1rem;
            --bs-card-group-margin: 0.75rem;
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            height: var(--bs-card-height);
            color: var(--bs-body-color);
            word-wrap: break-word;
            background-color: var(--bs-card-bg);
            background-clip: border-box;
            border: var(--bs-card-border-width) solid var(--bs-card-border-color);
            border-radius: var(--bs-card-border-radius)
        }

        .card>hr {
            margin-right: 0;
            margin-left: 0
        }

        .card>.list-group {
            border-top: inherit;
            border-bottom: inherit
        }

        .card>.list-group:first-child {
            border-top-width: 0;
            border-top-left-radius: var(--bs-card-inner-border-radius);
            border-top-right-radius: var(--bs-card-inner-border-radius)
        }

        .card>.list-group:last-child {
            border-bottom-width: 0;
            border-bottom-right-radius: var(--bs-card-inner-border-radius);
            border-bottom-left-radius: var(--bs-card-inner-border-radius)
        }

        .card>.card-header+.list-group,
        .card>.list-group+.card-footer {
            border-top: 0
        }

        .card-body {
            flex: 1 1 auto;
            padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
            color: var(--bs-card-color)
        }

        .card-title {
            margin-bottom: var(--bs-card-title-spacer-y);
            color: var(--bs-card-title-color)
        }

        .card-subtitle {
            margin-top: calc(-.5 * var(--bs-card-title-spacer-y));
            margin-bottom: 0;
            color: var(--bs-card-subtitle-color)
        }

        .card-text:last-child {
            margin-bottom: 0
        }

        .card-link+.card-link {
            margin-left: var(--bs-card-spacer-x)
        }

        .card-header {
            padding: var(--bs-card-cap-padding-y) var(--bs-card-cap-padding-x);
            margin-bottom: 0;
            color: var(--bs-card-cap-color);
            background-color: var(--bs-card-cap-bg);
            border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color)
        }

        .card-header:first-child {
            border-radius: var(--bs-card-inner-border-radius) var(--bs-card-inner-border-radius) 0 0
        }

        .card-footer {
            padding: var(--bs-card-cap-padding-y) var(--bs-card-cap-padding-x);
            color: var(--bs-card-cap-color);
            background-color: var(--bs-card-cap-bg);
            border-top: var(--bs-card-border-width) solid var(--bs-card-border-color)
        }

        .card-footer:last-child {
            border-radius: 0 0 var(--bs-card-inner-border-radius) var(--bs-card-inner-border-radius)
        }

        .card-header-tabs {
            margin-right: calc(-.5 * var(--bs-card-cap-padding-x));
            margin-bottom: calc(-1 * var(--bs-card-cap-padding-y));
            margin-left: calc(-.5 * var(--bs-card-cap-padding-x));
            border-bottom: 0
        }

        .card-header-tabs .nav-link.active {
            background-color: var(--bs-card-bg);
            border-bottom-color: var(--bs-card-bg)
        }

        .card-header-pills {
            margin-right: calc(-.5 * var(--bs-card-cap-padding-x));
            margin-left: calc(-.5 * var(--bs-card-cap-padding-x))
        }

        .card-img-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            padding: var(--bs-card-img-overlay-padding);
            border-radius: var(--bs-card-inner-border-radius)
        }

        .card-img,
        .card-img-bottom,
        .card-img-top {
            width: 100%
        }

        .card-img,
        .card-img-top {
            border-top-left-radius: var(--bs-card-inner-border-radius);
            border-top-right-radius: var(--bs-card-inner-border-radius)
        }

        .card-img,
        .card-img-bottom {
            border-bottom-right-radius: var(--bs-card-inner-border-radius);
            border-bottom-left-radius: var(--bs-card-inner-border-radius)
        }

        .card-group>.card {
            margin-bottom: var(--bs-card-group-margin)
        }

        @media (min-width:576px) {
            .card-group {
                display: flex;
                flex-flow: row wrap
            }

            .card-group>.card {
                flex: 1 0 0%;
                margin-bottom: 0
            }

            .card-group>.card+.card {
                margin-left: 0;
                border-left: 0
            }

            .card-group>.card:not(:last-child) {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0
            }

            .card-group>.card:not(:last-child) .card-header,
            .card-group>.card:not(:last-child) .card-img-top {
                border-top-right-radius: 0
            }

            .card-group>.card:not(:last-child) .card-footer,
            .card-group>.card:not(:last-child) .card-img-bottom {
                border-bottom-right-radius: 0
            }

            .card-group>.card:not(:first-child) {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0
            }

            .card-group>.card:not(:first-child) .card-header,
            .card-group>.card:not(:first-child) .card-img-top {
                border-top-left-radius: 0
            }

            .card-group>.card:not(:first-child) .card-footer,
            .card-group>.card:not(:first-child) .card-img-bottom {
                border-bottom-left-radius: 0
            }
        }

        .accordion {
            --bs-accordion-color: var(--bs-body-color);
            --bs-accordion-bg: var(--bs-body-bg);
            --bs-accordion-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, border-radius 0.15s ease;
            --bs-accordion-border-color: var(--bs-border-color);
            --bs-accordion-border-width: var(--bs-border-width);
            --bs-accordion-border-radius: var(--bs-border-radius);
            --bs-accordion-inner-border-radius: calc(var(--bs-border-radius) - (var(--bs-border-width)));
            --bs-accordion-btn-padding-x: 1.25rem;
            --bs-accordion-btn-padding-y: 1rem;
            --bs-accordion-btn-color: var(--bs-body-color);
            --bs-accordion-btn-bg: var(--bs-accordion-bg);
            --bs-accordion-btn-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            --bs-accordion-btn-icon-width: 1.25rem;
            --bs-accordion-btn-icon-transform: rotate(-180deg);
            --bs-accordion-btn-icon-transition: transform 0.2s ease-in-out;
            --bs-accordion-btn-active-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23052c65'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            --bs-accordion-btn-focus-border-color: #86b7fe;
            --bs-accordion-btn-focus-box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            --bs-accordion-body-padding-x: 1.25rem;
            --bs-accordion-body-padding-y: 1rem;
            --bs-accordion-active-color: var(--bs-primary-text-emphasis);
            --bs-accordion-active-bg: var(--bs-primary-bg-subtle)
        }

        .accordion-button {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            padding: var(--bs-accordion-btn-padding-y) var(--bs-accordion-btn-padding-x);
            font-size: 1rem;
            color: var(--bs-accordion-btn-color);
            text-align: left;
            background-color: var(--bs-accordion-btn-bg);
            border: 0;
            border-radius: 0;
            overflow-anchor: none;
            transition: var(--bs-accordion-transition)
        }

        @media (prefers-reduced-motion:reduce) {
            .accordion-button {
                transition: none
            }
        }

        .accordion-button:not(.collapsed) {
            color: var(--bs-accordion-active-color);
            background-color: var(--bs-accordion-active-bg);
            box-shadow: inset 0 calc(-1 * var(--bs-accordion-border-width)) 0 var(--bs-accordion-border-color)
        }

        .accordion-button:not(.collapsed)::after {
            background-image: var(--bs-accordion-btn-active-icon);
            transform: var(--bs-accordion-btn-icon-transform)
        }

        .accordion-button::after {
            flex-shrink: 0;
            width: var(--bs-accordion-btn-icon-width);
            height: var(--bs-accordion-btn-icon-width);
            margin-left: auto;
            content: "";
            background-image: var(--bs-accordion-btn-icon);
            background-repeat: no-repeat;
            background-size: var(--bs-accordion-btn-icon-width);
            transition: var(--bs-accordion-btn-icon-transition)
        }

        @media (prefers-reduced-motion:reduce) {
            .accordion-button::after {
                transition: none
            }
        }

        .accordion-button:hover {
            z-index: 2
        }

        .accordion-button:focus {
            z-index: 3;
            border-color: var(--bs-accordion-btn-focus-border-color);
            outline: 0;
            box-shadow: var(--bs-accordion-btn-focus-box-shadow)
        }

        .accordion-header {
            margin-bottom: 0
        }

        .accordion-item {
            color: var(--bs-accordion-color);
            background-color: var(--bs-accordion-bg);
            border: var(--bs-accordion-border-width) solid var(--bs-accordion-border-color)
        }

        .accordion-item:first-of-type {
            border-top-left-radius: var(--bs-accordion-border-radius);
            border-top-right-radius: var(--bs-accordion-border-radius)
        }

        .accordion-item:first-of-type .accordion-button {
            border-top-left-radius: var(--bs-accordion-inner-border-radius);
            border-top-right-radius: var(--bs-accordion-inner-border-radius)
        }

        .accordion-item:not(:first-of-type) {
            border-top: 0
        }

        .accordion-item:last-of-type {
            border-bottom-right-radius: var(--bs-accordion-border-radius);
            border-bottom-left-radius: var(--bs-accordion-border-radius)
        }

        .accordion-item:last-of-type .accordion-button.collapsed {
            border-bottom-right-radius: var(--bs-accordion-inner-border-radius);
            border-bottom-left-radius: var(--bs-accordion-inner-border-radius)
        }

        .accordion-item:last-of-type .accordion-collapse {
            border-bottom-right-radius: var(--bs-accordion-border-radius);
            border-bottom-left-radius: var(--bs-accordion-border-radius)
        }

        .accordion-body {
            padding: var(--bs-accordion-body-padding-y) var(--bs-accordion-body-padding-x)
        }

        .accordion-flush .accordion-collapse {
            border-width: 0
        }

        .accordion-flush .accordion-item {
            border-right: 0;
            border-left: 0;
            border-radius: 0
        }

        .accordion-flush .accordion-item:first-child {
            border-top: 0
        }

        .accordion-flush .accordion-item:last-child {
            border-bottom: 0
        }

        .accordion-flush .accordion-item .accordion-button,
        .accordion-flush .accordion-item .accordion-button.collapsed {
            border-radius: 0
        }

        [data-bs-theme=dark] .accordion-button::after {
            --bs-accordion-btn-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%236ea8fe'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            --bs-accordion-btn-active-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%236ea8fe'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e")
        }

        .breadcrumb {
            --bs-breadcrumb-padding-x: 0;
            --bs-breadcrumb-padding-y: 0;
            --bs-breadcrumb-margin-bottom: 1rem;
            --bs-breadcrumb-bg: ;
            --bs-breadcrumb-border-radius: ;
            --bs-breadcrumb-divider-color: var(--bs-secondary-color);
            --bs-breadcrumb-item-padding-x: 0.5rem;
            --bs-breadcrumb-item-active-color: var(--bs-secondary-color);
            display: flex;
            flex-wrap: wrap;
            padding: var(--bs-breadcrumb-padding-y) var(--bs-breadcrumb-padding-x);
            margin-bottom: var(--bs-breadcrumb-margin-bottom);
            font-size: var(--bs-breadcrumb-font-size);
            list-style: none;
            background-color: var(--bs-breadcrumb-bg);
            border-radius: var(--bs-breadcrumb-border-radius)
        }

        .breadcrumb-item+.breadcrumb-item {
            padding-left: var(--bs-breadcrumb-item-padding-x)
        }

        .breadcrumb-item+.breadcrumb-item::before {
            float: left;
            padding-right: var(--bs-breadcrumb-item-padding-x);
            color: var(--bs-breadcrumb-divider-color);
            content: var(--bs-breadcrumb-divider, "/")
        }

        .breadcrumb-item.active {
            color: var(--bs-breadcrumb-item-active-color)
        }

        .pagination {
            --bs-pagination-padding-x: 0.75rem;
            --bs-pagination-padding-y: 0.375rem;
            --bs-pagination-font-size: 1rem;
            --bs-pagination-color: var(--bs-link-color);
            --bs-pagination-bg: var(--bs-body-bg);
            --bs-pagination-border-width: var(--bs-border-width);
            --bs-pagination-border-color: var(--bs-border-color);
            --bs-pagination-border-radius: var(--bs-border-radius);
            --bs-pagination-hover-color: var(--bs-link-hover-color);
            --bs-pagination-hover-bg: var(--bs-tertiary-bg);
            --bs-pagination-hover-border-color: var(--bs-border-color);
            --bs-pagination-focus-color: var(--bs-link-hover-color);
            --bs-pagination-focus-bg: var(--bs-secondary-bg);
            --bs-pagination-focus-box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            --bs-pagination-active-color: #fff;
            --bs-pagination-active-bg: #0d6efd;
            --bs-pagination-active-border-color: #0d6efd;
            --bs-pagination-disabled-color: var(--bs-secondary-color);
            --bs-pagination-disabled-bg: var(--bs-secondary-bg);
            --bs-pagination-disabled-border-color: var(--bs-border-color);
            display: flex;
            padding-left: 0;
            list-style: none
        }

        .page-link {
            position: relative;
            display: block;
            padding: var(--bs-pagination-padding-y) var(--bs-pagination-padding-x);
            font-size: var(--bs-pagination-font-size);
            color: var(--bs-pagination-color);
            text-decoration: none;
            background-color: var(--bs-pagination-bg);
            border: var(--bs-pagination-border-width) solid var(--bs-pagination-border-color);
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .page-link {
                transition: none
            }
        }

        .page-link:hover {
            z-index: 2;
            color: var(--bs-pagination-hover-color);
            background-color: var(--bs-pagination-hover-bg);
            border-color: var(--bs-pagination-hover-border-color)
        }

        .page-link:focus {
            z-index: 3;
            color: var(--bs-pagination-focus-color);
            background-color: var(--bs-pagination-focus-bg);
            outline: 0;
            box-shadow: var(--bs-pagination-focus-box-shadow)
        }

        .active>.page-link,
        .page-link.active {
            z-index: 3;
            color: var(--bs-pagination-active-color);
            background-color: var(--bs-pagination-active-bg);
            border-color: var(--bs-pagination-active-border-color)
        }

        .disabled>.page-link,
        .page-link.disabled {
            color: var(--bs-pagination-disabled-color);
            pointer-events: none;
            background-color: var(--bs-pagination-disabled-bg);
            border-color: var(--bs-pagination-disabled-border-color)
        }

        .page-item:not(:first-child) .page-link {
            margin-left: calc(var(--bs-border-width) * -1)
        }

        .page-item:first-child .page-link {
            border-top-left-radius: var(--bs-pagination-border-radius);
            border-bottom-left-radius: var(--bs-pagination-border-radius)
        }

        .page-item:last-child .page-link {
            border-top-right-radius: var(--bs-pagination-border-radius);
            border-bottom-right-radius: var(--bs-pagination-border-radius)
        }

        .pagination-lg {
            --bs-pagination-padding-x: 1.5rem;
            --bs-pagination-padding-y: 0.75rem;
            --bs-pagination-font-size: 1.25rem;
            --bs-pagination-border-radius: var(--bs-border-radius-lg)
        }

        .pagination-sm {
            --bs-pagination-padding-x: 0.5rem;
            --bs-pagination-padding-y: 0.25rem;
            --bs-pagination-font-size: 0.875rem;
            --bs-pagination-border-radius: var(--bs-border-radius-sm)
        }

        .badge {
            --bs-badge-padding-x: 0.65em;
            --bs-badge-padding-y: 0.35em;
            --bs-badge-font-size: 0.75em;
            --bs-badge-font-weight: 700;
            --bs-badge-color: #fff;
            --bs-badge-border-radius: var(--bs-border-radius);
            display: inline-block;
            padding: var(--bs-badge-padding-y) var(--bs-badge-padding-x);
            font-size: var(--bs-badge-font-size);
            font-weight: var(--bs-badge-font-weight);
            line-height: 1;
            color: var(--bs-badge-color);
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: var(--bs-badge-border-radius)
        }

        .badge:empty {
            display: none
        }

        .btn .badge {
            position: relative;
            top: -1px
        }

        .alert {
            --bs-alert-bg: transparent;
            --bs-alert-padding-x: 1rem;
            --bs-alert-padding-y: 1rem;
            --bs-alert-margin-bottom: 1rem;
            --bs-alert-color: inherit;
            --bs-alert-border-color: transparent;
            --bs-alert-border: var(--bs-border-width) solid var(--bs-alert-border-color);
            --bs-alert-border-radius: var(--bs-border-radius);
            --bs-alert-link-color: inherit;
            position: relative;
            padding: var(--bs-alert-padding-y) var(--bs-alert-padding-x);
            margin-bottom: var(--bs-alert-margin-bottom);
            color: var(--bs-alert-color);
            background-color: var(--bs-alert-bg);
            border: var(--bs-alert-border);
            border-radius: var(--bs-alert-border-radius)
        }

        .alert-heading {
            color: inherit
        }

        .alert-link {
            font-weight: 700;
            color: var(--bs-alert-link-color)
        }

        .alert-dismissible {
            padding-right: 3rem
        }

        .alert-dismissible .btn-close {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
            padding: 1.25rem 1rem
        }

        .alert-primary {
            --bs-alert-color: var(--bs-primary-text-emphasis);
            --bs-alert-bg: var(--bs-primary-bg-subtle);
            --bs-alert-border-color: var(--bs-primary-border-subtle);
            --bs-alert-link-color: var(--bs-primary-text-emphasis)
        }

        .alert-secondary {
            --bs-alert-color: var(--bs-secondary-text-emphasis);
            --bs-alert-bg: var(--bs-secondary-bg-subtle);
            --bs-alert-border-color: var(--bs-secondary-border-subtle);
            --bs-alert-link-color: var(--bs-secondary-text-emphasis)
        }

        .alert-success {
            --bs-alert-color: var(--bs-success-text-emphasis);
            --bs-alert-bg: var(--bs-success-bg-subtle);
            --bs-alert-border-color: var(--bs-success-border-subtle);
            --bs-alert-link-color: var(--bs-success-text-emphasis)
        }

        .alert-info {
            --bs-alert-color: var(--bs-info-text-emphasis);
            --bs-alert-bg: var(--bs-info-bg-subtle);
            --bs-alert-border-color: var(--bs-info-border-subtle);
            --bs-alert-link-color: var(--bs-info-text-emphasis)
        }

        .alert-warning {
            --bs-alert-color: var(--bs-warning-text-emphasis);
            --bs-alert-bg: var(--bs-warning-bg-subtle);
            --bs-alert-border-color: var(--bs-warning-border-subtle);
            --bs-alert-link-color: var(--bs-warning-text-emphasis)
        }

        .alert-danger {
            --bs-alert-color: var(--bs-danger-text-emphasis);
            --bs-alert-bg: var(--bs-danger-bg-subtle);
            --bs-alert-border-color: var(--bs-danger-border-subtle);
            --bs-alert-link-color: var(--bs-danger-text-emphasis)
        }

        .alert-light {
            --bs-alert-color: var(--bs-light-text-emphasis);
            --bs-alert-bg: var(--bs-light-bg-subtle);
            --bs-alert-border-color: var(--bs-light-border-subtle);
            --bs-alert-link-color: var(--bs-light-text-emphasis)
        }

        .alert-dark {
            --bs-alert-color: var(--bs-dark-text-emphasis);
            --bs-alert-bg: var(--bs-dark-bg-subtle);
            --bs-alert-border-color: var(--bs-dark-border-subtle);
            --bs-alert-link-color: var(--bs-dark-text-emphasis)
        }

        @keyframes progress-bar-stripes {
            0% {
                background-position-x: 1rem
            }
        }

        .progress,
        .progress-stacked {
            --bs-progress-height: 1rem;
            --bs-progress-font-size: 0.75rem;
            --bs-progress-bg: var(--bs-secondary-bg);
            --bs-progress-border-radius: var(--bs-border-radius);
            --bs-progress-box-shadow: var(--bs-box-shadow-inset);
            --bs-progress-bar-color: #fff;
            --bs-progress-bar-bg: #0d6efd;
            --bs-progress-bar-transition: width 0.6s ease;
            display: flex;
            height: var(--bs-progress-height);
            overflow: hidden;
            font-size: var(--bs-progress-font-size);
            background-color: var(--bs-progress-bg);
            border-radius: var(--bs-progress-border-radius)
        }

        .progress-bar {
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
            color: var(--bs-progress-bar-color);
            text-align: center;
            white-space: nowrap;
            background-color: var(--bs-progress-bar-bg);
            transition: var(--bs-progress-bar-transition)
        }

        @media (prefers-reduced-motion:reduce) {
            .progress-bar {
                transition: none
            }
        }

        .progress-bar-striped {
            background-image: linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
            background-size: var(--bs-progress-height) var(--bs-progress-height)
        }

        .progress-stacked>.progress {
            overflow: visible
        }

        .progress-stacked>.progress>.progress-bar {
            width: 100%
        }

        .progress-bar-animated {
            animation: 1s linear infinite progress-bar-stripes
        }

        @media (prefers-reduced-motion:reduce) {
            .progress-bar-animated {
                animation: none
            }
        }

        .list-group {
            --bs-list-group-color: var(--bs-body-color);
            --bs-list-group-bg: var(--bs-body-bg);
            --bs-list-group-border-color: var(--bs-border-color);
            --bs-list-group-border-width: var(--bs-border-width);
            --bs-list-group-border-radius: var(--bs-border-radius);
            --bs-list-group-item-padding-x: 1rem;
            --bs-list-group-item-padding-y: 0.5rem;
            --bs-list-group-action-color: var(--bs-secondary-color);
            --bs-list-group-action-hover-color: var(--bs-emphasis-color);
            --bs-list-group-action-hover-bg: var(--bs-tertiary-bg);
            --bs-list-group-action-active-color: var(--bs-body-color);
            --bs-list-group-action-active-bg: var(--bs-secondary-bg);
            --bs-list-group-disabled-color: var(--bs-secondary-color);
            --bs-list-group-disabled-bg: var(--bs-body-bg);
            --bs-list-group-active-color: #fff;
            --bs-list-group-active-bg: #0d6efd;
            --bs-list-group-active-border-color: #0d6efd;
            display: flex;
            flex-direction: column;
            padding-left: 0;
            margin-bottom: 0;
            border-radius: var(--bs-list-group-border-radius)
        }

        .list-group-numbered {
            list-style-type: none;
            counter-reset: section
        }

        .list-group-numbered>.list-group-item::before {
            content: counters(section, ".") ". ";
            counter-increment: section
        }

        .list-group-item-action {
            width: 100%;
            color: var(--bs-list-group-action-color);
            text-align: inherit
        }

        .list-group-item-action:focus,
        .list-group-item-action:hover {
            z-index: 1;
            color: var(--bs-list-group-action-hover-color);
            text-decoration: none;
            background-color: var(--bs-list-group-action-hover-bg)
        }

        .list-group-item-action:active {
            color: var(--bs-list-group-action-active-color);
            background-color: var(--bs-list-group-action-active-bg)
        }

        .list-group-item {
            position: relative;
            display: block;
            padding: var(--bs-list-group-item-padding-y) var(--bs-list-group-item-padding-x);
            color: var(--bs-list-group-color);
            text-decoration: none;
            background-color: var(--bs-list-group-bg);
            border: var(--bs-list-group-border-width) solid var(--bs-list-group-border-color)
        }

        .list-group-item:first-child {
            border-top-left-radius: inherit;
            border-top-right-radius: inherit
        }

        .list-group-item:last-child {
            border-bottom-right-radius: inherit;
            border-bottom-left-radius: inherit
        }

        .list-group-item.disabled,
        .list-group-item:disabled {
            color: var(--bs-list-group-disabled-color);
            pointer-events: none;
            background-color: var(--bs-list-group-disabled-bg)
        }

        .list-group-item.active {
            z-index: 2;
            color: var(--bs-list-group-active-color);
            background-color: var(--bs-list-group-active-bg);
            border-color: var(--bs-list-group-active-border-color)
        }

        .list-group-item+.list-group-item {
            border-top-width: 0
        }

        .list-group-item+.list-group-item.active {
            margin-top: calc(-1 * var(--bs-list-group-border-width));
            border-top-width: var(--bs-list-group-border-width)
        }

        .list-group-horizontal {
            flex-direction: row
        }

        .list-group-horizontal>.list-group-item:first-child:not(:last-child) {
            border-bottom-left-radius: var(--bs-list-group-border-radius);
            border-top-right-radius: 0
        }

        .list-group-horizontal>.list-group-item:last-child:not(:first-child) {
            border-top-right-radius: var(--bs-list-group-border-radius);
            border-bottom-left-radius: 0
        }

        .list-group-horizontal>.list-group-item.active {
            margin-top: 0
        }

        .list-group-horizontal>.list-group-item+.list-group-item {
            border-top-width: var(--bs-list-group-border-width);
            border-left-width: 0
        }

        .list-group-horizontal>.list-group-item+.list-group-item.active {
            margin-left: calc(-1 * var(--bs-list-group-border-width));
            border-left-width: var(--bs-list-group-border-width)
        }

        @media (min-width:576px) {
            .list-group-horizontal-sm {
                flex-direction: row
            }

            .list-group-horizontal-sm>.list-group-item:first-child:not(:last-child) {
                border-bottom-left-radius: var(--bs-list-group-border-radius);
                border-top-right-radius: 0
            }

            .list-group-horizontal-sm>.list-group-item:last-child:not(:first-child) {
                border-top-right-radius: var(--bs-list-group-border-radius);
                border-bottom-left-radius: 0
            }

            .list-group-horizontal-sm>.list-group-item.active {
                margin-top: 0
            }

            .list-group-horizontal-sm>.list-group-item+.list-group-item {
                border-top-width: var(--bs-list-group-border-width);
                border-left-width: 0
            }

            .list-group-horizontal-sm>.list-group-item+.list-group-item.active {
                margin-left: calc(-1 * var(--bs-list-group-border-width));
                border-left-width: var(--bs-list-group-border-width)
            }
        }

        @media (min-width:768px) {
            .list-group-horizontal-md {
                flex-direction: row
            }

            .list-group-horizontal-md>.list-group-item:first-child:not(:last-child) {
                border-bottom-left-radius: var(--bs-list-group-border-radius);
                border-top-right-radius: 0
            }

            .list-group-horizontal-md>.list-group-item:last-child:not(:first-child) {
                border-top-right-radius: var(--bs-list-group-border-radius);
                border-bottom-left-radius: 0
            }

            .list-group-horizontal-md>.list-group-item.active {
                margin-top: 0
            }

            .list-group-horizontal-md>.list-group-item+.list-group-item {
                border-top-width: var(--bs-list-group-border-width);
                border-left-width: 0
            }

            .list-group-horizontal-md>.list-group-item+.list-group-item.active {
                margin-left: calc(-1 * var(--bs-list-group-border-width));
                border-left-width: var(--bs-list-group-border-width)
            }
        }

        @media (min-width:992px) {
            .list-group-horizontal-lg {
                flex-direction: row
            }

            .list-group-horizontal-lg>.list-group-item:first-child:not(:last-child) {
                border-bottom-left-radius: var(--bs-list-group-border-radius);
                border-top-right-radius: 0
            }

            .list-group-horizontal-lg>.list-group-item:last-child:not(:first-child) {
                border-top-right-radius: var(--bs-list-group-border-radius);
                border-bottom-left-radius: 0
            }

            .list-group-horizontal-lg>.list-group-item.active {
                margin-top: 0
            }

            .list-group-horizontal-lg>.list-group-item+.list-group-item {
                border-top-width: var(--bs-list-group-border-width);
                border-left-width: 0
            }

            .list-group-horizontal-lg>.list-group-item+.list-group-item.active {
                margin-left: calc(-1 * var(--bs-list-group-border-width));
                border-left-width: var(--bs-list-group-border-width)
            }
        }

        @media (min-width:1200px) {
            .list-group-horizontal-xl {
                flex-direction: row
            }

            .list-group-horizontal-xl>.list-group-item:first-child:not(:last-child) {
                border-bottom-left-radius: var(--bs-list-group-border-radius);
                border-top-right-radius: 0
            }

            .list-group-horizontal-xl>.list-group-item:last-child:not(:first-child) {
                border-top-right-radius: var(--bs-list-group-border-radius);
                border-bottom-left-radius: 0
            }

            .list-group-horizontal-xl>.list-group-item.active {
                margin-top: 0
            }

            .list-group-horizontal-xl>.list-group-item+.list-group-item {
                border-top-width: var(--bs-list-group-border-width);
                border-left-width: 0
            }

            .list-group-horizontal-xl>.list-group-item+.list-group-item.active {
                margin-left: calc(-1 * var(--bs-list-group-border-width));
                border-left-width: var(--bs-list-group-border-width)
            }
        }

        @media (min-width:1400px) {
            .list-group-horizontal-xxl {
                flex-direction: row
            }

            .list-group-horizontal-xxl>.list-group-item:first-child:not(:last-child) {
                border-bottom-left-radius: var(--bs-list-group-border-radius);
                border-top-right-radius: 0
            }

            .list-group-horizontal-xxl>.list-group-item:last-child:not(:first-child) {
                border-top-right-radius: var(--bs-list-group-border-radius);
                border-bottom-left-radius: 0
            }

            .list-group-horizontal-xxl>.list-group-item.active {
                margin-top: 0
            }

            .list-group-horizontal-xxl>.list-group-item+.list-group-item {
                border-top-width: var(--bs-list-group-border-width);
                border-left-width: 0
            }

            .list-group-horizontal-xxl>.list-group-item+.list-group-item.active {
                margin-left: calc(-1 * var(--bs-list-group-border-width));
                border-left-width: var(--bs-list-group-border-width)
            }
        }

        .list-group-flush {
            border-radius: 0
        }

        .list-group-flush>.list-group-item {
            border-width: 0 0 var(--bs-list-group-border-width)
        }

        .list-group-flush>.list-group-item:last-child {
            border-bottom-width: 0
        }

        .list-group-item-primary {
            --bs-list-group-color: var(--bs-primary-text-emphasis);
            --bs-list-group-bg: var(--bs-primary-bg-subtle);
            --bs-list-group-border-color: var(--bs-primary-border-subtle);
            --bs-list-group-action-hover-color: var(--bs-emphasis-color);
            --bs-list-group-action-hover-bg: var(--bs-primary-border-subtle);
            --bs-list-group-action-active-color: var(--bs-emphasis-color);
            --bs-list-group-action-active-bg: var(--bs-primary-border-subtle);
            --bs-list-group-active-color: var(--bs-primary-bg-subtle);
            --bs-list-group-active-bg: var(--bs-primary-text-emphasis);
            --bs-list-group-active-border-color: var(--bs-primary-text-emphasis)
        }

        .list-group-item-secondary {
            --bs-list-group-color: var(--bs-secondary-text-emphasis);
            --bs-list-group-bg: var(--bs-secondary-bg-subtle);
            --bs-list-group-border-color: var(--bs-secondary-border-subtle);
            --bs-list-group-action-hover-color: var(--bs-emphasis-color);
            --bs-list-group-action-hover-bg: var(--bs-secondary-border-subtle);
            --bs-list-group-action-active-color: var(--bs-emphasis-color);
            --bs-list-group-action-active-bg: var(--bs-secondary-border-subtle);
            --bs-list-group-active-color: var(--bs-secondary-bg-subtle);
            --bs-list-group-active-bg: var(--bs-secondary-text-emphasis);
            --bs-list-group-active-border-color: var(--bs-secondary-text-emphasis)
        }

        .list-group-item-success {
            --bs-list-group-color: var(--bs-success-text-emphasis);
            --bs-list-group-bg: var(--bs-success-bg-subtle);
            --bs-list-group-border-color: var(--bs-success-border-subtle);
            --bs-list-group-action-hover-color: var(--bs-emphasis-color);
            --bs-list-group-action-hover-bg: var(--bs-success-border-subtle);
            --bs-list-group-action-active-color: var(--bs-emphasis-color);
            --bs-list-group-action-active-bg: var(--bs-success-border-subtle);
            --bs-list-group-active-color: var(--bs-success-bg-subtle);
            --bs-list-group-active-bg: var(--bs-success-text-emphasis);
            --bs-list-group-active-border-color: var(--bs-success-text-emphasis)
        }

        .list-group-item-info {
            --bs-list-group-color: var(--bs-info-text-emphasis);
            --bs-list-group-bg: var(--bs-info-bg-subtle);
            --bs-list-group-border-color: var(--bs-info-border-subtle);
            --bs-list-group-action-hover-color: var(--bs-emphasis-color);
            --bs-list-group-action-hover-bg: var(--bs-info-border-subtle);
            --bs-list-group-action-active-color: var(--bs-emphasis-color);
            --bs-list-group-action-active-bg: var(--bs-info-border-subtle);
            --bs-list-group-active-color: var(--bs-info-bg-subtle);
            --bs-list-group-active-bg: var(--bs-info-text-emphasis);
            --bs-list-group-active-border-color: var(--bs-info-text-emphasis)
        }

        .list-group-item-warning {
            --bs-list-group-color: var(--bs-warning-text-emphasis);
            --bs-list-group-bg: var(--bs-warning-bg-subtle);
            --bs-list-group-border-color: var(--bs-warning-border-subtle);
            --bs-list-group-action-hover-color: var(--bs-emphasis-color);
            --bs-list-group-action-hover-bg: var(--bs-warning-border-subtle);
            --bs-list-group-action-active-color: var(--bs-emphasis-color);
            --bs-list-group-action-active-bg: var(--bs-warning-border-subtle);
            --bs-list-group-active-color: var(--bs-warning-bg-subtle);
            --bs-list-group-active-bg: var(--bs-warning-text-emphasis);
            --bs-list-group-active-border-color: var(--bs-warning-text-emphasis)
        }

        .list-group-item-danger {
            --bs-list-group-color: var(--bs-danger-text-emphasis);
            --bs-list-group-bg: var(--bs-danger-bg-subtle);
            --bs-list-group-border-color: var(--bs-danger-border-subtle);
            --bs-list-group-action-hover-color: var(--bs-emphasis-color);
            --bs-list-group-action-hover-bg: var(--bs-danger-border-subtle);
            --bs-list-group-action-active-color: var(--bs-emphasis-color);
            --bs-list-group-action-active-bg: var(--bs-danger-border-subtle);
            --bs-list-group-active-color: var(--bs-danger-bg-subtle);
            --bs-list-group-active-bg: var(--bs-danger-text-emphasis);
            --bs-list-group-active-border-color: var(--bs-danger-text-emphasis)
        }

        .list-group-item-light {
            --bs-list-group-color: var(--bs-light-text-emphasis);
            --bs-list-group-bg: var(--bs-light-bg-subtle);
            --bs-list-group-border-color: var(--bs-light-border-subtle);
            --bs-list-group-action-hover-color: var(--bs-emphasis-color);
            --bs-list-group-action-hover-bg: var(--bs-light-border-subtle);
            --bs-list-group-action-active-color: var(--bs-emphasis-color);
            --bs-list-group-action-active-bg: var(--bs-light-border-subtle);
            --bs-list-group-active-color: var(--bs-light-bg-subtle);
            --bs-list-group-active-bg: var(--bs-light-text-emphasis);
            --bs-list-group-active-border-color: var(--bs-light-text-emphasis)
        }

        .list-group-item-dark {
            --bs-list-group-color: var(--bs-dark-text-emphasis);
            --bs-list-group-bg: var(--bs-dark-bg-subtle);
            --bs-list-group-border-color: var(--bs-dark-border-subtle);
            --bs-list-group-action-hover-color: var(--bs-emphasis-color);
            --bs-list-group-action-hover-bg: var(--bs-dark-border-subtle);
            --bs-list-group-action-active-color: var(--bs-emphasis-color);
            --bs-list-group-action-active-bg: var(--bs-dark-border-subtle);
            --bs-list-group-active-color: var(--bs-dark-bg-subtle);
            --bs-list-group-active-bg: var(--bs-dark-text-emphasis);
            --bs-list-group-active-border-color: var(--bs-dark-text-emphasis)
        }

        .btn-close {
            --bs-btn-close-color: #000;
            --bs-btn-close-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e");
            --bs-btn-close-opacity: 0.5;
            --bs-btn-close-hover-opacity: 0.75;
            --bs-btn-close-focus-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            --bs-btn-close-focus-opacity: 1;
            --bs-btn-close-disabled-opacity: 0.25;
            --bs-btn-close-white-filter: invert(1) grayscale(100%) brightness(200%);
            box-sizing: content-box;
            width: 1em;
            height: 1em;
            padding: .25em .25em;
            color: var(--bs-btn-close-color);
            background: transparent var(--bs-btn-close-bg) center/1em auto no-repeat;
            border: 0;
            border-radius: .375rem;
            opacity: var(--bs-btn-close-opacity)
        }

        .btn-close:hover {
            color: var(--bs-btn-close-color);
            text-decoration: none;
            opacity: var(--bs-btn-close-hover-opacity)
        }

        .btn-close:focus {
            outline: 0;
            box-shadow: var(--bs-btn-close-focus-shadow);
            opacity: var(--bs-btn-close-focus-opacity)
        }

        .btn-close.disabled,
        .btn-close:disabled {
            pointer-events: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            opacity: var(--bs-btn-close-disabled-opacity)
        }

        .btn-close-white {
            filter: var(--bs-btn-close-white-filter)
        }

        [data-bs-theme=dark] .btn-close {
            filter: var(--bs-btn-close-white-filter)
        }

        .toast {
            --bs-toast-zindex: 1090;
            --bs-toast-padding-x: 0.75rem;
            --bs-toast-padding-y: 0.5rem;
            --bs-toast-spacing: 1.5rem;
            --bs-toast-max-width: 350px;
            --bs-toast-font-size: 0.875rem;
            --bs-toast-color: ;
            --bs-toast-bg: rgba(var(--bs-body-bg-rgb), 0.85);
            --bs-toast-border-width: var(--bs-border-width);
            --bs-toast-border-color: var(--bs-border-color-translucent);
            --bs-toast-border-radius: var(--bs-border-radius);
            --bs-toast-box-shadow: var(--bs-box-shadow);
            --bs-toast-header-color: var(--bs-secondary-color);
            --bs-toast-header-bg: rgba(var(--bs-body-bg-rgb), 0.85);
            --bs-toast-header-border-color: var(--bs-border-color-translucent);
            width: var(--bs-toast-max-width);
            max-width: 100%;
            font-size: var(--bs-toast-font-size);
            color: var(--bs-toast-color);
            pointer-events: auto;
            background-color: var(--bs-toast-bg);
            background-clip: padding-box;
            border: var(--bs-toast-border-width) solid var(--bs-toast-border-color);
            box-shadow: var(--bs-toast-box-shadow);
            border-radius: var(--bs-toast-border-radius)
        }

        .toast.showing {
            opacity: 0
        }

        .toast:not(.show) {
            display: none
        }

        .toast-container {
            --bs-toast-zindex: 1090;
            position: absolute;
            z-index: var(--bs-toast-zindex);
            width: -webkit-max-content;
            width: -moz-max-content;
            width: max-content;
            max-width: 100%;
            pointer-events: none
        }

        .toast-container>:not(:last-child) {
            margin-bottom: var(--bs-toast-spacing)
        }

        .toast-header {
            display: flex;
            align-items: center;
            padding: var(--bs-toast-padding-y) var(--bs-toast-padding-x);
            color: var(--bs-toast-header-color);
            background-color: var(--bs-toast-header-bg);
            background-clip: padding-box;
            border-bottom: var(--bs-toast-border-width) solid var(--bs-toast-header-border-color);
            border-top-left-radius: calc(var(--bs-toast-border-radius) - var(--bs-toast-border-width));
            border-top-right-radius: calc(var(--bs-toast-border-radius) - var(--bs-toast-border-width))
        }

        .toast-header .btn-close {
            margin-right: calc(-.5 * var(--bs-toast-padding-x));
            margin-left: var(--bs-toast-padding-x)
        }

        .toast-body {
            padding: var(--bs-toast-padding-x);
            word-wrap: break-word
        }

        .modal {
            --bs-modal-zindex: 1055;
            --bs-modal-width: 500px;
            --bs-modal-padding: 1rem;
            --bs-modal-margin: 0.5rem;
            --bs-modal-color: ;
            --bs-modal-bg: var(--bs-body-bg);
            --bs-modal-border-color: var(--bs-border-color-translucent);
            --bs-modal-border-width: var(--bs-border-width);
            --bs-modal-border-radius: var(--bs-border-radius-lg);
            --bs-modal-box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --bs-modal-inner-border-radius: calc(var(--bs-border-radius-lg) - (var(--bs-border-width)));
            --bs-modal-header-padding-x: 1rem;
            --bs-modal-header-padding-y: 1rem;
            --bs-modal-header-padding: 1rem 1rem;
            --bs-modal-header-border-color: var(--bs-border-color);
            --bs-modal-header-border-width: var(--bs-border-width);
            --bs-modal-title-line-height: 1.5;
            --bs-modal-footer-gap: 0.5rem;
            --bs-modal-footer-bg: ;
            --bs-modal-footer-border-color: var(--bs-border-color);
            --bs-modal-footer-border-width: var(--bs-border-width);
            position: fixed;
            top: 0;
            left: 0;
            z-index: var(--bs-modal-zindex);
            display: none;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            overflow-y: auto;
            outline: 0
        }

        .modal-dialog {
            position: relative;
            width: auto;
            margin: var(--bs-modal-margin);
            pointer-events: none
        }

        .modal.fade .modal-dialog {
            transition: transform .3s ease-out;
            transform: translate(0, -50px)
        }

        @media (prefers-reduced-motion:reduce) {
            .modal.fade .modal-dialog {
                transition: none
            }
        }

        .modal.show .modal-dialog {
            transform: none
        }

        .modal.modal-static .modal-dialog {
            transform: scale(1.02)
        }

        .modal-dialog-scrollable {
            height: calc(100% - var(--bs-modal-margin) * 2)
        }

        .modal-dialog-scrollable .modal-content {
            max-height: 100%;
            overflow: hidden
        }

        .modal-dialog-scrollable .modal-body {
            overflow-y: auto
        }

        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - var(--bs-modal-margin) * 2)
        }

        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            color: var(--bs-modal-color);
            pointer-events: auto;
            background-color: var(--bs-modal-bg);
            background-clip: padding-box;
            border: var(--bs-modal-border-width) solid var(--bs-modal-border-color);
            border-radius: var(--bs-modal-border-radius);
            outline: 0
        }

        .modal-backdrop {
            --bs-backdrop-zindex: 1050;
            --bs-backdrop-bg: #000;
            --bs-backdrop-opacity: 0.5;
            position: fixed;
            top: 0;
            left: 0;
            z-index: var(--bs-backdrop-zindex);
            width: 100vw;
            height: 100vh;
            background-color: var(--bs-backdrop-bg)
        }

        .modal-backdrop.fade {
            opacity: 0
        }

        .modal-backdrop.show {
            opacity: var(--bs-backdrop-opacity)
        }

        .modal-header {
            display: flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: space-between;
            padding: var(--bs-modal-header-padding);
            border-bottom: var(--bs-modal-header-border-width) solid var(--bs-modal-header-border-color);
            border-top-left-radius: var(--bs-modal-inner-border-radius);
            border-top-right-radius: var(--bs-modal-inner-border-radius)
        }

        .modal-header .btn-close {
            padding: calc(var(--bs-modal-header-padding-y) * .5) calc(var(--bs-modal-header-padding-x) * .5);
            margin: calc(-.5 * var(--bs-modal-header-padding-y)) calc(-.5 * var(--bs-modal-header-padding-x)) calc(-.5 * var(--bs-modal-header-padding-y)) auto
        }

        .modal-title {
            margin-bottom: 0;
            line-height: var(--bs-modal-title-line-height)
        }

        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: var(--bs-modal-padding)
        }

        .modal-footer {
            display: flex;
            flex-shrink: 0;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            padding: calc(var(--bs-modal-padding) - var(--bs-modal-footer-gap) * .5);
            background-color: var(--bs-modal-footer-bg);
            border-top: var(--bs-modal-footer-border-width) solid var(--bs-modal-footer-border-color);
            border-bottom-right-radius: var(--bs-modal-inner-border-radius);
            border-bottom-left-radius: var(--bs-modal-inner-border-radius)
        }

        .modal-footer>* {
            margin: calc(var(--bs-modal-footer-gap) * .5)
        }

        @media (min-width:576px) {
            .modal {
                --bs-modal-margin: 1.75rem;
                --bs-modal-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15)
            }

            .modal-dialog {
                max-width: var(--bs-modal-width);
                margin-right: auto;
                margin-left: auto
            }

            .modal-sm {
                --bs-modal-width: 300px
            }
        }

        @media (min-width:992px) {

            .modal-lg,
            .modal-xl {
                --bs-modal-width: 800px
            }
        }

        @media (min-width:1200px) {
            .modal-xl {
                --bs-modal-width: 1140px
            }
        }

        .modal-fullscreen {
            width: 100vw;
            max-width: none;
            height: 100%;
            margin: 0
        }

        .modal-fullscreen .modal-content {
            height: 100%;
            border: 0;
            border-radius: 0
        }

        .modal-fullscreen .modal-footer,
        .modal-fullscreen .modal-header {
            border-radius: 0
        }

        .modal-fullscreen .modal-body {
            overflow-y: auto
        }

        @media (max-width:575.98px) {
            .modal-fullscreen-sm-down {
                width: 100vw;
                max-width: none;
                height: 100%;
                margin: 0
            }

            .modal-fullscreen-sm-down .modal-content {
                height: 100%;
                border: 0;
                border-radius: 0
            }

            .modal-fullscreen-sm-down .modal-footer,
            .modal-fullscreen-sm-down .modal-header {
                border-radius: 0
            }

            .modal-fullscreen-sm-down .modal-body {
                overflow-y: auto
            }
        }

        @media (max-width:767.98px) {
            .modal-fullscreen-md-down {
                width: 100vw;
                max-width: none;
                height: 100%;
                margin: 0
            }

            .modal-fullscreen-md-down .modal-content {
                height: 100%;
                border: 0;
                border-radius: 0
            }

            .modal-fullscreen-md-down .modal-footer,
            .modal-fullscreen-md-down .modal-header {
                border-radius: 0
            }

            .modal-fullscreen-md-down .modal-body {
                overflow-y: auto
            }
        }

        @media (max-width:991.98px) {
            .modal-fullscreen-lg-down {
                width: 100vw;
                max-width: none;
                height: 100%;
                margin: 0
            }

            .modal-fullscreen-lg-down .modal-content {
                height: 100%;
                border: 0;
                border-radius: 0
            }

            .modal-fullscreen-lg-down .modal-footer,
            .modal-fullscreen-lg-down .modal-header {
                border-radius: 0
            }

            .modal-fullscreen-lg-down .modal-body {
                overflow-y: auto
            }
        }

        @media (max-width:1199.98px) {
            .modal-fullscreen-xl-down {
                width: 100vw;
                max-width: none;
                height: 100%;
                margin: 0
            }

            .modal-fullscreen-xl-down .modal-content {
                height: 100%;
                border: 0;
                border-radius: 0
            }

            .modal-fullscreen-xl-down .modal-footer,
            .modal-fullscreen-xl-down .modal-header {
                border-radius: 0
            }

            .modal-fullscreen-xl-down .modal-body {
                overflow-y: auto
            }
        }

        @media (max-width:1399.98px) {
            .modal-fullscreen-xxl-down {
                width: 100vw;
                max-width: none;
                height: 100%;
                margin: 0
            }

            .modal-fullscreen-xxl-down .modal-content {
                height: 100%;
                border: 0;
                border-radius: 0
            }

            .modal-fullscreen-xxl-down .modal-footer,
            .modal-fullscreen-xxl-down .modal-header {
                border-radius: 0
            }

            .modal-fullscreen-xxl-down .modal-body {
                overflow-y: auto
            }
        }

        .tooltip {
            --bs-tooltip-zindex: 1080;
            --bs-tooltip-max-width: 200px;
            --bs-tooltip-padding-x: 0.5rem;
            --bs-tooltip-padding-y: 0.25rem;
            --bs-tooltip-margin: ;
            --bs-tooltip-font-size: 0.875rem;
            --bs-tooltip-color: var(--bs-body-bg);
            --bs-tooltip-bg: var(--bs-emphasis-color);
            --bs-tooltip-border-radius: var(--bs-border-radius);
            --bs-tooltip-opacity: 0.9;
            --bs-tooltip-arrow-width: 0.8rem;
            --bs-tooltip-arrow-height: 0.4rem;
            z-index: var(--bs-tooltip-zindex);
            display: block;
            margin: var(--bs-tooltip-margin);
            font-family: var(--bs-font-sans-serif);
            font-style: normal;
            font-weight: 400;
            line-height: 1.5;
            text-align: left;
            text-align: start;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
            letter-spacing: normal;
            word-break: normal;
            white-space: normal;
            word-spacing: normal;
            line-break: auto;
            font-size: var(--bs-tooltip-font-size);
            word-wrap: break-word;
            opacity: 0
        }

        .tooltip.show {
            opacity: var(--bs-tooltip-opacity)
        }

        .tooltip .tooltip-arrow {
            display: block;
            width: var(--bs-tooltip-arrow-width);
            height: var(--bs-tooltip-arrow-height)
        }

        .tooltip .tooltip-arrow::before {
            position: absolute;
            content: "";
            border-color: transparent;
            border-style: solid
        }

        .bs-tooltip-auto[data-popper-placement^=top] .tooltip-arrow,
        .bs-tooltip-top .tooltip-arrow {
            bottom: calc(-1 * var(--bs-tooltip-arrow-height))
        }

        .bs-tooltip-auto[data-popper-placement^=top] .tooltip-arrow::before,
        .bs-tooltip-top .tooltip-arrow::before {
            top: -1px;
            border-width: var(--bs-tooltip-arrow-height) calc(var(--bs-tooltip-arrow-width) * .5) 0;
            border-top-color: var(--bs-tooltip-bg)
        }

        .bs-tooltip-auto[data-popper-placement^=right] .tooltip-arrow,
        .bs-tooltip-end .tooltip-arrow {
            left: calc(-1 * var(--bs-tooltip-arrow-height));
            width: var(--bs-tooltip-arrow-height);
            height: var(--bs-tooltip-arrow-width)
        }

        .bs-tooltip-auto[data-popper-placement^=right] .tooltip-arrow::before,
        .bs-tooltip-end .tooltip-arrow::before {
            right: -1px;
            border-width: calc(var(--bs-tooltip-arrow-width) * .5) var(--bs-tooltip-arrow-height) calc(var(--bs-tooltip-arrow-width) * .5) 0;
            border-right-color: var(--bs-tooltip-bg)
        }

        .bs-tooltip-auto[data-popper-placement^=bottom] .tooltip-arrow,
        .bs-tooltip-bottom .tooltip-arrow {
            top: calc(-1 * var(--bs-tooltip-arrow-height))
        }

        .bs-tooltip-auto[data-popper-placement^=bottom] .tooltip-arrow::before,
        .bs-tooltip-bottom .tooltip-arrow::before {
            bottom: -1px;
            border-width: 0 calc(var(--bs-tooltip-arrow-width) * .5) var(--bs-tooltip-arrow-height);
            border-bottom-color: var(--bs-tooltip-bg)
        }

        .bs-tooltip-auto[data-popper-placement^=left] .tooltip-arrow,
        .bs-tooltip-start .tooltip-arrow {
            right: calc(-1 * var(--bs-tooltip-arrow-height));
            width: var(--bs-tooltip-arrow-height);
            height: var(--bs-tooltip-arrow-width)
        }

        .bs-tooltip-auto[data-popper-placement^=left] .tooltip-arrow::before,
        .bs-tooltip-start .tooltip-arrow::before {
            left: -1px;
            border-width: calc(var(--bs-tooltip-arrow-width) * .5) 0 calc(var(--bs-tooltip-arrow-width) * .5) var(--bs-tooltip-arrow-height);
            border-left-color: var(--bs-tooltip-bg)
        }

        .tooltip-inner {
            max-width: var(--bs-tooltip-max-width);
            padding: var(--bs-tooltip-padding-y) var(--bs-tooltip-padding-x);
            color: var(--bs-tooltip-color);
            text-align: center;
            background-color: var(--bs-tooltip-bg);
            border-radius: var(--bs-tooltip-border-radius)
        }

        .popover {
            --bs-popover-zindex: 1070;
            --bs-popover-max-width: 276px;
            --bs-popover-font-size: 0.875rem;
            --bs-popover-bg: var(--bs-body-bg);
            --bs-popover-border-width: var(--bs-border-width);
            --bs-popover-border-color: var(--bs-border-color-translucent);
            --bs-popover-border-radius: var(--bs-border-radius-lg);
            --bs-popover-inner-border-radius: calc(var(--bs-border-radius-lg) - var(--bs-border-width));
            --bs-popover-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            --bs-popover-header-padding-x: 1rem;
            --bs-popover-header-padding-y: 0.5rem;
            --bs-popover-header-font-size: 1rem;
            --bs-popover-header-color: inherit;
            --bs-popover-header-bg: var(--bs-secondary-bg);
            --bs-popover-body-padding-x: 1rem;
            --bs-popover-body-padding-y: 1rem;
            --bs-popover-body-color: var(--bs-body-color);
            --bs-popover-arrow-width: 1rem;
            --bs-popover-arrow-height: 0.5rem;
            --bs-popover-arrow-border: var(--bs-popover-border-color);
            z-index: var(--bs-popover-zindex);
            display: block;
            max-width: var(--bs-popover-max-width);
            font-family: var(--bs-font-sans-serif);
            font-style: normal;
            font-weight: 400;
            line-height: 1.5;
            text-align: left;
            text-align: start;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
            letter-spacing: normal;
            word-break: normal;
            white-space: normal;
            word-spacing: normal;
            line-break: auto;
            font-size: var(--bs-popover-font-size);
            word-wrap: break-word;
            background-color: var(--bs-popover-bg);
            background-clip: padding-box;
            border: var(--bs-popover-border-width) solid var(--bs-popover-border-color);
            border-radius: var(--bs-popover-border-radius)
        }

        .popover .popover-arrow {
            display: block;
            width: var(--bs-popover-arrow-width);
            height: var(--bs-popover-arrow-height)
        }

        .popover .popover-arrow::after,
        .popover .popover-arrow::before {
            position: absolute;
            display: block;
            content: "";
            border-color: transparent;
            border-style: solid;
            border-width: 0
        }

        .bs-popover-auto[data-popper-placement^=top]>.popover-arrow,
        .bs-popover-top>.popover-arrow {
            bottom: calc(-1 * (var(--bs-popover-arrow-height)) - var(--bs-popover-border-width))
        }

        .bs-popover-auto[data-popper-placement^=top]>.popover-arrow::after,
        .bs-popover-auto[data-popper-placement^=top]>.popover-arrow::before,
        .bs-popover-top>.popover-arrow::after,
        .bs-popover-top>.popover-arrow::before {
            border-width: var(--bs-popover-arrow-height) calc(var(--bs-popover-arrow-width) * .5) 0
        }

        .bs-popover-auto[data-popper-placement^=top]>.popover-arrow::before,
        .bs-popover-top>.popover-arrow::before {
            bottom: 0;
            border-top-color: var(--bs-popover-arrow-border)
        }

        .bs-popover-auto[data-popper-placement^=top]>.popover-arrow::after,
        .bs-popover-top>.popover-arrow::after {
            bottom: var(--bs-popover-border-width);
            border-top-color: var(--bs-popover-bg)
        }

        .bs-popover-auto[data-popper-placement^=right]>.popover-arrow,
        .bs-popover-end>.popover-arrow {
            left: calc(-1 * (var(--bs-popover-arrow-height)) - var(--bs-popover-border-width));
            width: var(--bs-popover-arrow-height);
            height: var(--bs-popover-arrow-width)
        }

        .bs-popover-auto[data-popper-placement^=right]>.popover-arrow::after,
        .bs-popover-auto[data-popper-placement^=right]>.popover-arrow::before,
        .bs-popover-end>.popover-arrow::after,
        .bs-popover-end>.popover-arrow::before {
            border-width: calc(var(--bs-popover-arrow-width) * .5) var(--bs-popover-arrow-height) calc(var(--bs-popover-arrow-width) * .5) 0
        }

        .bs-popover-auto[data-popper-placement^=right]>.popover-arrow::before,
        .bs-popover-end>.popover-arrow::before {
            left: 0;
            border-right-color: var(--bs-popover-arrow-border)
        }

        .bs-popover-auto[data-popper-placement^=right]>.popover-arrow::after,
        .bs-popover-end>.popover-arrow::after {
            left: var(--bs-popover-border-width);
            border-right-color: var(--bs-popover-bg)
        }

        .bs-popover-auto[data-popper-placement^=bottom]>.popover-arrow,
        .bs-popover-bottom>.popover-arrow {
            top: calc(-1 * (var(--bs-popover-arrow-height)) - var(--bs-popover-border-width))
        }

        .bs-popover-auto[data-popper-placement^=bottom]>.popover-arrow::after,
        .bs-popover-auto[data-popper-placement^=bottom]>.popover-arrow::before,
        .bs-popover-bottom>.popover-arrow::after,
        .bs-popover-bottom>.popover-arrow::before {
            border-width: 0 calc(var(--bs-popover-arrow-width) * .5) var(--bs-popover-arrow-height)
        }

        .bs-popover-auto[data-popper-placement^=bottom]>.popover-arrow::before,
        .bs-popover-bottom>.popover-arrow::before {
            top: 0;
            border-bottom-color: var(--bs-popover-arrow-border)
        }

        .bs-popover-auto[data-popper-placement^=bottom]>.popover-arrow::after,
        .bs-popover-bottom>.popover-arrow::after {
            top: var(--bs-popover-border-width);
            border-bottom-color: var(--bs-popover-bg)
        }

        .bs-popover-auto[data-popper-placement^=bottom] .popover-header::before,
        .bs-popover-bottom .popover-header::before {
            position: absolute;
            top: 0;
            left: 50%;
            display: block;
            width: var(--bs-popover-arrow-width);
            margin-left: calc(-.5 * var(--bs-popover-arrow-width));
            content: "";
            border-bottom: var(--bs-popover-border-width) solid var(--bs-popover-header-bg)
        }

        .bs-popover-auto[data-popper-placement^=left]>.popover-arrow,
        .bs-popover-start>.popover-arrow {
            right: calc(-1 * (var(--bs-popover-arrow-height)) - var(--bs-popover-border-width));
            width: var(--bs-popover-arrow-height);
            height: var(--bs-popover-arrow-width)
        }

        .bs-popover-auto[data-popper-placement^=left]>.popover-arrow::after,
        .bs-popover-auto[data-popper-placement^=left]>.popover-arrow::before,
        .bs-popover-start>.popover-arrow::after,
        .bs-popover-start>.popover-arrow::before {
            border-width: calc(var(--bs-popover-arrow-width) * .5) 0 calc(var(--bs-popover-arrow-width) * .5) var(--bs-popover-arrow-height)
        }

        .bs-popover-auto[data-popper-placement^=left]>.popover-arrow::before,
        .bs-popover-start>.popover-arrow::before {
            right: 0;
            border-left-color: var(--bs-popover-arrow-border)
        }

        .bs-popover-auto[data-popper-placement^=left]>.popover-arrow::after,
        .bs-popover-start>.popover-arrow::after {
            right: var(--bs-popover-border-width);
            border-left-color: var(--bs-popover-bg)
        }

        .popover-header {
            padding: var(--bs-popover-header-padding-y) var(--bs-popover-header-padding-x);
            margin-bottom: 0;
            font-size: var(--bs-popover-header-font-size);
            color: var(--bs-popover-header-color);
            background-color: var(--bs-popover-header-bg);
            border-bottom: var(--bs-popover-border-width) solid var(--bs-popover-border-color);
            border-top-left-radius: var(--bs-popover-inner-border-radius);
            border-top-right-radius: var(--bs-popover-inner-border-radius)
        }

        .popover-header:empty {
            display: none
        }

        .popover-body {
            padding: var(--bs-popover-body-padding-y) var(--bs-popover-body-padding-x);
            color: var(--bs-popover-body-color)
        }

        .carousel {
            position: relative
        }

        .carousel.pointer-event {
            touch-action: pan-y
        }

        .carousel-inner {
            position: relative;
            width: 100%;
            overflow: hidden
        }

        .carousel-inner::after {
            display: block;
            clear: both;
            content: ""
        }

        .carousel-item {
            position: relative;
            display: none;
            float: left;
            width: 100%;
            margin-right: -100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transition: transform .6s ease-in-out
        }

        @media (prefers-reduced-motion:reduce) {
            .carousel-item {
                transition: none
            }
        }

        .carousel-item-next,
        .carousel-item-prev,
        .carousel-item.active {
            display: block
        }

        .active.carousel-item-end,
        .carousel-item-next:not(.carousel-item-start) {
            transform: translateX(100%)
        }

        .active.carousel-item-start,
        .carousel-item-prev:not(.carousel-item-end) {
            transform: translateX(-100%)
        }

        .carousel-fade .carousel-item {
            opacity: 0;
            transition-property: opacity;
            transform: none
        }

        .carousel-fade .carousel-item-next.carousel-item-start,
        .carousel-fade .carousel-item-prev.carousel-item-end,
        .carousel-fade .carousel-item.active {
            z-index: 1;
            opacity: 1
        }

        .carousel-fade .active.carousel-item-end,
        .carousel-fade .active.carousel-item-start {
            z-index: 0;
            opacity: 0;
            transition: opacity 0s .6s
        }

        @media (prefers-reduced-motion:reduce) {

            .carousel-fade .active.carousel-item-end,
            .carousel-fade .active.carousel-item-start {
                transition: none
            }
        }

        .carousel-control-next,
        .carousel-control-prev {
            position: absolute;
            top: 0;
            bottom: 0;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 15%;
            padding: 0;
            color: #fff;
            text-align: center;
            background: 0 0;
            border: 0;
            opacity: .5;
            transition: opacity .15s ease
        }

        @media (prefers-reduced-motion:reduce) {

            .carousel-control-next,
            .carousel-control-prev {
                transition: none
            }
        }

        .carousel-control-next:focus,
        .carousel-control-next:hover,
        .carousel-control-prev:focus,
        .carousel-control-prev:hover {
            color: #fff;
            text-decoration: none;
            outline: 0;
            opacity: .9
        }

        .carousel-control-prev {
            left: 0
        }

        .carousel-control-next {
            right: 0
        }

        .carousel-control-next-icon,
        .carousel-control-prev-icon {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            background-repeat: no-repeat;
            background-position: 50%;
            background-size: 100% 100%
        }

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3e%3c/svg%3e")
        }

        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e")
        }

        .carousel-indicators {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 2;
            display: flex;
            justify-content: center;
            padding: 0;
            margin-right: 15%;
            margin-bottom: 1rem;
            margin-left: 15%
        }

        .carousel-indicators [data-bs-target] {
            box-sizing: content-box;
            flex: 0 1 auto;
            width: 30px;
            height: 3px;
            padding: 0;
            margin-right: 3px;
            margin-left: 3px;
            text-indent: -999px;
            cursor: pointer;
            background-color: #fff;
            background-clip: padding-box;
            border: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            opacity: .5;
            transition: opacity .6s ease
        }

        @media (prefers-reduced-motion:reduce) {
            .carousel-indicators [data-bs-target] {
                transition: none
            }
        }

        .carousel-indicators .active {
            opacity: 1
        }

        .carousel-caption {
            position: absolute;
            right: 15%;
            bottom: 1.25rem;
            left: 15%;
            padding-top: 1.25rem;
            padding-bottom: 1.25rem;
            color: #fff;
            text-align: center
        }

        .carousel-dark .carousel-control-next-icon,
        .carousel-dark .carousel-control-prev-icon {
            filter: invert(1) grayscale(100)
        }

        .carousel-dark .carousel-indicators [data-bs-target] {
            background-color: #000
        }

        .carousel-dark .carousel-caption {
            color: #000
        }

        [data-bs-theme=dark] .carousel .carousel-control-next-icon,
        [data-bs-theme=dark] .carousel .carousel-control-prev-icon,
        [data-bs-theme=dark].carousel .carousel-control-next-icon,
        [data-bs-theme=dark].carousel .carousel-control-prev-icon {
            filter: invert(1) grayscale(100)
        }

        [data-bs-theme=dark] .carousel .carousel-indicators [data-bs-target],
        [data-bs-theme=dark].carousel .carousel-indicators [data-bs-target] {
            background-color: #000
        }

        [data-bs-theme=dark] .carousel .carousel-caption,
        [data-bs-theme=dark].carousel .carousel-caption {
            color: #000
        }

        .spinner-border,
        .spinner-grow {
            display: inline-block;
            width: var(--bs-spinner-width);
            height: var(--bs-spinner-height);
            vertical-align: var(--bs-spinner-vertical-align);
            border-radius: 50%;
            animation: var(--bs-spinner-animation-speed) linear infinite var(--bs-spinner-animation-name)
        }

        @keyframes spinner-border {
            to {
                transform: rotate(360deg)
            }
        }

        .spinner-border {
            --bs-spinner-width: 2rem;
            --bs-spinner-height: 2rem;
            --bs-spinner-vertical-align: -0.125em;
            --bs-spinner-border-width: 0.25em;
            --bs-spinner-animation-speed: 0.75s;
            --bs-spinner-animation-name: spinner-border;
            border: var(--bs-spinner-border-width) solid currentcolor;
            border-right-color: transparent
        }

        .spinner-border-sm {
            --bs-spinner-width: 1rem;
            --bs-spinner-height: 1rem;
            --bs-spinner-border-width: 0.2em
        }

        @keyframes spinner-grow {
            0% {
                transform: scale(0)
            }

            50% {
                opacity: 1;
                transform: none
            }
        }

        .spinner-grow {
            --bs-spinner-width: 2rem;
            --bs-spinner-height: 2rem;
            --bs-spinner-vertical-align: -0.125em;
            --bs-spinner-animation-speed: 0.75s;
            --bs-spinner-animation-name: spinner-grow;
            background-color: currentcolor;
            opacity: 0
        }

        .spinner-grow-sm {
            --bs-spinner-width: 1rem;
            --bs-spinner-height: 1rem
        }

        @media (prefers-reduced-motion:reduce) {

            .spinner-border,
            .spinner-grow {
                --bs-spinner-animation-speed: 1.5s
            }
        }

        .offcanvas,
        .offcanvas-lg,
        .offcanvas-md,
        .offcanvas-sm,
        .offcanvas-xl,
        .offcanvas-xxl {
            --bs-offcanvas-zindex: 1045;
            --bs-offcanvas-width: 400px;
            --bs-offcanvas-height: 30vh;
            --bs-offcanvas-padding-x: 1rem;
            --bs-offcanvas-padding-y: 1rem;
            --bs-offcanvas-color: var(--bs-body-color);
            --bs-offcanvas-bg: var(--bs-body-bg);
            --bs-offcanvas-border-width: var(--bs-border-width);
            --bs-offcanvas-border-color: var(--bs-border-color-translucent);
            --bs-offcanvas-box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --bs-offcanvas-transition: transform 0.3s ease-in-out;
            --bs-offcanvas-title-line-height: 1.5
        }

        @media (max-width:575.98px) {
            .offcanvas-sm {
                position: fixed;
                bottom: 0;
                z-index: var(--bs-offcanvas-zindex);
                display: flex;
                flex-direction: column;
                max-width: 100%;
                color: var(--bs-offcanvas-color);
                visibility: hidden;
                background-color: var(--bs-offcanvas-bg);
                background-clip: padding-box;
                outline: 0;
                transition: var(--bs-offcanvas-transition)
            }
        }

        @media (max-width:575.98px) and (prefers-reduced-motion:reduce) {
            .offcanvas-sm {
                transition: none
            }
        }

        @media (max-width:575.98px) {
            .offcanvas-sm.offcanvas-start {
                top: 0;
                left: 0;
                width: var(--bs-offcanvas-width);
                border-right: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateX(-100%)
            }

            .offcanvas-sm.offcanvas-end {
                top: 0;
                right: 0;
                width: var(--bs-offcanvas-width);
                border-left: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateX(100%)
            }

            .offcanvas-sm.offcanvas-top {
                top: 0;
                right: 0;
                left: 0;
                height: var(--bs-offcanvas-height);
                max-height: 100%;
                border-bottom: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateY(-100%)
            }

            .offcanvas-sm.offcanvas-bottom {
                right: 0;
                left: 0;
                height: var(--bs-offcanvas-height);
                max-height: 100%;
                border-top: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateY(100%)
            }

            .offcanvas-sm.show:not(.hiding),
            .offcanvas-sm.showing {
                transform: none
            }

            .offcanvas-sm.hiding,
            .offcanvas-sm.show,
            .offcanvas-sm.showing {
                visibility: visible
            }
        }

        @media (min-width:576px) {
            .offcanvas-sm {
                --bs-offcanvas-height: auto;
                --bs-offcanvas-border-width: 0;
                background-color: transparent !important
            }

            .offcanvas-sm .offcanvas-header {
                display: none
            }

            .offcanvas-sm .offcanvas-body {
                display: flex;
                flex-grow: 0;
                padding: 0;
                overflow-y: visible;
                background-color: transparent !important
            }
        }

        @media (max-width:767.98px) {
            .offcanvas-md {
                position: fixed;
                bottom: 0;
                z-index: var(--bs-offcanvas-zindex);
                display: flex;
                flex-direction: column;
                max-width: 100%;
                color: var(--bs-offcanvas-color);
                visibility: hidden;
                background-color: var(--bs-offcanvas-bg);
                background-clip: padding-box;
                outline: 0;
                transition: var(--bs-offcanvas-transition)
            }
        }

        @media (max-width:767.98px) and (prefers-reduced-motion:reduce) {
            .offcanvas-md {
                transition: none
            }
        }

        @media (max-width:767.98px) {
            .offcanvas-md.offcanvas-start {
                top: 0;
                left: 0;
                width: var(--bs-offcanvas-width);
                border-right: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateX(-100%)
            }

            .offcanvas-md.offcanvas-end {
                top: 0;
                right: 0;
                width: var(--bs-offcanvas-width);
                border-left: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateX(100%)
            }

            .offcanvas-md.offcanvas-top {
                top: 0;
                right: 0;
                left: 0;
                height: var(--bs-offcanvas-height);
                max-height: 100%;
                border-bottom: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateY(-100%)
            }

            .offcanvas-md.offcanvas-bottom {
                right: 0;
                left: 0;
                height: var(--bs-offcanvas-height);
                max-height: 100%;
                border-top: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateY(100%)
            }

            .offcanvas-md.show:not(.hiding),
            .offcanvas-md.showing {
                transform: none
            }

            .offcanvas-md.hiding,
            .offcanvas-md.show,
            .offcanvas-md.showing {
                visibility: visible
            }
        }

        @media (min-width:768px) {
            .offcanvas-md {
                --bs-offcanvas-height: auto;
                --bs-offcanvas-border-width: 0;
                background-color: transparent !important
            }

            .offcanvas-md .offcanvas-header {
                display: none
            }

            .offcanvas-md .offcanvas-body {
                display: flex;
                flex-grow: 0;
                padding: 0;
                overflow-y: visible;
                background-color: transparent !important
            }
        }

        @media (max-width:991.98px) {
            .offcanvas-lg {
                position: fixed;
                bottom: 0;
                z-index: var(--bs-offcanvas-zindex);
                display: flex;
                flex-direction: column;
                max-width: 100%;
                color: var(--bs-offcanvas-color);
                visibility: hidden;
                background-color: var(--bs-offcanvas-bg);
                background-clip: padding-box;
                outline: 0;
                transition: var(--bs-offcanvas-transition)
            }
        }

        @media (max-width:991.98px) and (prefers-reduced-motion:reduce) {
            .offcanvas-lg {
                transition: none
            }
        }

        @media (max-width:991.98px) {
            .offcanvas-lg.offcanvas-start {
                top: 0;
                left: 0;
                width: var(--bs-offcanvas-width);
                border-right: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateX(-100%)
            }

            .offcanvas-lg.offcanvas-end {
                top: 0;
                right: 0;
                width: var(--bs-offcanvas-width);
                border-left: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateX(100%)
            }

            .offcanvas-lg.offcanvas-top {
                top: 0;
                right: 0;
                left: 0;
                height: var(--bs-offcanvas-height);
                max-height: 100%;
                border-bottom: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateY(-100%)
            }

            .offcanvas-lg.offcanvas-bottom {
                right: 0;
                left: 0;
                height: var(--bs-offcanvas-height);
                max-height: 100%;
                border-top: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateY(100%)
            }

            .offcanvas-lg.show:not(.hiding),
            .offcanvas-lg.showing {
                transform: none
            }

            .offcanvas-lg.hiding,
            .offcanvas-lg.show,
            .offcanvas-lg.showing {
                visibility: visible
            }
        }

        @media (min-width:992px) {
            .offcanvas-lg {
                --bs-offcanvas-height: auto;
                --bs-offcanvas-border-width: 0;
                background-color: transparent !important
            }

            .offcanvas-lg .offcanvas-header {
                display: none
            }

            .offcanvas-lg .offcanvas-body {
                display: flex;
                flex-grow: 0;
                padding: 0;
                overflow-y: visible;
                background-color: transparent !important
            }
        }

        @media (max-width:1199.98px) {
            .offcanvas-xl {
                position: fixed;
                bottom: 0;
                z-index: var(--bs-offcanvas-zindex);
                display: flex;
                flex-direction: column;
                max-width: 100%;
                color: var(--bs-offcanvas-color);
                visibility: hidden;
                background-color: var(--bs-offcanvas-bg);
                background-clip: padding-box;
                outline: 0;
                transition: var(--bs-offcanvas-transition)
            }
        }

        @media (max-width:1199.98px) and (prefers-reduced-motion:reduce) {
            .offcanvas-xl {
                transition: none
            }
        }

        @media (max-width:1199.98px) {
            .offcanvas-xl.offcanvas-start {
                top: 0;
                left: 0;
                width: var(--bs-offcanvas-width);
                border-right: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateX(-100%)
            }

            .offcanvas-xl.offcanvas-end {
                top: 0;
                right: 0;
                width: var(--bs-offcanvas-width);
                border-left: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateX(100%)
            }

            .offcanvas-xl.offcanvas-top {
                top: 0;
                right: 0;
                left: 0;
                height: var(--bs-offcanvas-height);
                max-height: 100%;
                border-bottom: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateY(-100%)
            }

            .offcanvas-xl.offcanvas-bottom {
                right: 0;
                left: 0;
                height: var(--bs-offcanvas-height);
                max-height: 100%;
                border-top: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateY(100%)
            }

            .offcanvas-xl.show:not(.hiding),
            .offcanvas-xl.showing {
                transform: none
            }

            .offcanvas-xl.hiding,
            .offcanvas-xl.show,
            .offcanvas-xl.showing {
                visibility: visible
            }
        }

        @media (min-width:1200px) {
            .offcanvas-xl {
                --bs-offcanvas-height: auto;
                --bs-offcanvas-border-width: 0;
                background-color: transparent !important
            }

            .offcanvas-xl .offcanvas-header {
                display: none
            }

            .offcanvas-xl .offcanvas-body {
                display: flex;
                flex-grow: 0;
                padding: 0;
                overflow-y: visible;
                background-color: transparent !important
            }
        }

        @media (max-width:1399.98px) {
            .offcanvas-xxl {
                position: fixed;
                bottom: 0;
                z-index: var(--bs-offcanvas-zindex);
                display: flex;
                flex-direction: column;
                max-width: 100%;
                color: var(--bs-offcanvas-color);
                visibility: hidden;
                background-color: var(--bs-offcanvas-bg);
                background-clip: padding-box;
                outline: 0;
                transition: var(--bs-offcanvas-transition)
            }
        }

        @media (max-width:1399.98px) and (prefers-reduced-motion:reduce) {
            .offcanvas-xxl {
                transition: none
            }
        }

        @media (max-width:1399.98px) {
            .offcanvas-xxl.offcanvas-start {
                top: 0;
                left: 0;
                width: var(--bs-offcanvas-width);
                border-right: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateX(-100%)
            }

            .offcanvas-xxl.offcanvas-end {
                top: 0;
                right: 0;
                width: var(--bs-offcanvas-width);
                border-left: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateX(100%)
            }

            .offcanvas-xxl.offcanvas-top {
                top: 0;
                right: 0;
                left: 0;
                height: var(--bs-offcanvas-height);
                max-height: 100%;
                border-bottom: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateY(-100%)
            }

            .offcanvas-xxl.offcanvas-bottom {
                right: 0;
                left: 0;
                height: var(--bs-offcanvas-height);
                max-height: 100%;
                border-top: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
                transform: translateY(100%)
            }

            .offcanvas-xxl.show:not(.hiding),
            .offcanvas-xxl.showing {
                transform: none
            }

            .offcanvas-xxl.hiding,
            .offcanvas-xxl.show,
            .offcanvas-xxl.showing {
                visibility: visible
            }
        }

        @media (min-width:1400px) {
            .offcanvas-xxl {
                --bs-offcanvas-height: auto;
                --bs-offcanvas-border-width: 0;
                background-color: transparent !important
            }

            .offcanvas-xxl .offcanvas-header {
                display: none
            }

            .offcanvas-xxl .offcanvas-body {
                display: flex;
                flex-grow: 0;
                padding: 0;
                overflow-y: visible;
                background-color: transparent !important
            }
        }

        .offcanvas {
            position: fixed;
            bottom: 0;
            z-index: var(--bs-offcanvas-zindex);
            display: flex;
            flex-direction: column;
            max-width: 100%;
            color: var(--bs-offcanvas-color);
            visibility: hidden;
            background-color: var(--bs-offcanvas-bg);
            background-clip: padding-box;
            outline: 0;
            transition: var(--bs-offcanvas-transition)
        }

        @media (prefers-reduced-motion:reduce) {
            .offcanvas {
                transition: none
            }
        }

        .offcanvas.offcanvas-start {
            top: 0;
            left: 0;
            width: var(--bs-offcanvas-width);
            border-right: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
            transform: translateX(-100%)
        }

        .offcanvas.offcanvas-end {
            top: 0;
            right: 0;
            width: var(--bs-offcanvas-width);
            border-left: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
            transform: translateX(100%)
        }

        .offcanvas.offcanvas-top {
            top: 0;
            right: 0;
            left: 0;
            height: var(--bs-offcanvas-height);
            max-height: 100%;
            border-bottom: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
            transform: translateY(-100%)
        }

        .offcanvas.offcanvas-bottom {
            right: 0;
            left: 0;
            height: var(--bs-offcanvas-height);
            max-height: 100%;
            border-top: var(--bs-offcanvas-border-width) solid var(--bs-offcanvas-border-color);
            transform: translateY(100%)
        }

        .offcanvas.show:not(.hiding),
        .offcanvas.showing {
            transform: none
        }

        .offcanvas.hiding,
        .offcanvas.show,
        .offcanvas.showing {
            visibility: visible
        }

        .offcanvas-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            width: 100vw;
            height: 100vh;
            background-color: #000
        }

        .offcanvas-backdrop.fade {
            opacity: 0
        }

        .offcanvas-backdrop.show {
            opacity: .5
        }

        .offcanvas-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--bs-offcanvas-padding-y) var(--bs-offcanvas-padding-x)
        }

        .offcanvas-header .btn-close {
            padding: calc(var(--bs-offcanvas-padding-y) * .5) calc(var(--bs-offcanvas-padding-x) * .5);
            margin-top: calc(-.5 * var(--bs-offcanvas-padding-y));
            margin-right: calc(-.5 * var(--bs-offcanvas-padding-x));
            margin-bottom: calc(-.5 * var(--bs-offcanvas-padding-y))
        }

        .offcanvas-title {
            margin-bottom: 0;
            line-height: var(--bs-offcanvas-title-line-height)
        }

        .offcanvas-body {
            flex-grow: 1;
            padding: var(--bs-offcanvas-padding-y) var(--bs-offcanvas-padding-x);
            overflow-y: auto
        }

        .placeholder {
            display: inline-block;
            min-height: 1em;
            vertical-align: middle;
            cursor: wait;
            background-color: currentcolor;
            opacity: .5
        }

        .placeholder.btn::before {
            display: inline-block;
            content: ""
        }

        .placeholder-xs {
            min-height: .6em
        }

        .placeholder-sm {
            min-height: .8em
        }

        .placeholder-lg {
            min-height: 1.2em
        }

        .placeholder-glow .placeholder {
            animation: placeholder-glow 2s ease-in-out infinite
        }

        @keyframes placeholder-glow {
            50% {
                opacity: .2
            }
        }

        .placeholder-wave {
            -webkit-mask-image: linear-gradient(130deg, #000 55%, rgba(0, 0, 0, 0.8) 75%, #000 95%);
            mask-image: linear-gradient(130deg, #000 55%, rgba(0, 0, 0, 0.8) 75%, #000 95%);
            -webkit-mask-size: 200% 100%;
            mask-size: 200% 100%;
            animation: placeholder-wave 2s linear infinite
        }

        @keyframes placeholder-wave {
            100% {
                -webkit-mask-position: -200% 0%;
                mask-position: -200% 0%
            }
        }

        .clearfix::after {
            display: block;
            clear: both;
            content: ""
        }

        .text-bg-primary {
            color: #fff !important;
            background-color: RGBA(13, 110, 253, var(--bs-bg-opacity, 1)) !important
        }

        .text-bg-secondary {
            color: #fff !important;
            background-color: RGBA(108, 117, 125, var(--bs-bg-opacity, 1)) !important
        }

        .text-bg-success {
            color: #fff !important;
            background-color: RGBA(25, 135, 84, var(--bs-bg-opacity, 1)) !important
        }

        .text-bg-info {
            color: #000 !important;
            background-color: RGBA(13, 202, 240, var(--bs-bg-opacity, 1)) !important
        }

        .text-bg-warning {
            color: #000 !important;
            background-color: RGBA(255, 193, 7, var(--bs-bg-opacity, 1)) !important
        }

        .text-bg-danger {
            color: #fff !important;
            background-color: RGBA(220, 53, 69, var(--bs-bg-opacity, 1)) !important
        }

        .text-bg-light {
            color: #000 !important;
            background-color: RGBA(248, 249, 250, var(--bs-bg-opacity, 1)) !important
        }

        .text-bg-dark {
            color: #fff !important;
            background-color: RGBA(33, 37, 41, var(--bs-bg-opacity, 1)) !important
        }

        .link-primary {
            color: RGBA(var(--bs-primary-rgb), var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(var(--bs-primary-rgb), var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(var(--bs-primary-rgb), var(--bs-link-underline-opacity, 1)) !important
        }

        .link-primary:focus,
        .link-primary:hover {
            color: RGBA(10, 88, 202, var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(10, 88, 202, var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(10, 88, 202, var(--bs-link-underline-opacity, 1)) !important
        }

        .link-secondary {
            color: RGBA(var(--bs-secondary-rgb), var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(var(--bs-secondary-rgb), var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(var(--bs-secondary-rgb), var(--bs-link-underline-opacity, 1)) !important
        }

        .link-secondary:focus,
        .link-secondary:hover {
            color: RGBA(86, 94, 100, var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(86, 94, 100, var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(86, 94, 100, var(--bs-link-underline-opacity, 1)) !important
        }

        .link-success {
            color: RGBA(var(--bs-success-rgb), var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(var(--bs-success-rgb), var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(var(--bs-success-rgb), var(--bs-link-underline-opacity, 1)) !important
        }

        .link-success:focus,
        .link-success:hover {
            color: RGBA(20, 108, 67, var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(20, 108, 67, var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(20, 108, 67, var(--bs-link-underline-opacity, 1)) !important
        }

        .link-info {
            color: RGBA(var(--bs-info-rgb), var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(var(--bs-info-rgb), var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(var(--bs-info-rgb), var(--bs-link-underline-opacity, 1)) !important
        }

        .link-info:focus,
        .link-info:hover {
            color: RGBA(61, 213, 243, var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(61, 213, 243, var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(61, 213, 243, var(--bs-link-underline-opacity, 1)) !important
        }

        .link-warning {
            color: RGBA(var(--bs-warning-rgb), var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(var(--bs-warning-rgb), var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(var(--bs-warning-rgb), var(--bs-link-underline-opacity, 1)) !important
        }

        .link-warning:focus,
        .link-warning:hover {
            color: RGBA(255, 205, 57, var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(255, 205, 57, var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(255, 205, 57, var(--bs-link-underline-opacity, 1)) !important
        }

        .link-danger {
            color: RGBA(var(--bs-danger-rgb), var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(var(--bs-danger-rgb), var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(var(--bs-danger-rgb), var(--bs-link-underline-opacity, 1)) !important
        }

        .link-danger:focus,
        .link-danger:hover {
            color: RGBA(176, 42, 55, var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(176, 42, 55, var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(176, 42, 55, var(--bs-link-underline-opacity, 1)) !important
        }

        .link-light {
            color: RGBA(var(--bs-light-rgb), var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(var(--bs-light-rgb), var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(var(--bs-light-rgb), var(--bs-link-underline-opacity, 1)) !important
        }

        .link-light:focus,
        .link-light:hover {
            color: RGBA(249, 250, 251, var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(249, 250, 251, var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(249, 250, 251, var(--bs-link-underline-opacity, 1)) !important
        }

        .link-dark {
            color: RGBA(var(--bs-dark-rgb), var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(var(--bs-dark-rgb), var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(var(--bs-dark-rgb), var(--bs-link-underline-opacity, 1)) !important
        }

        .link-dark:focus,
        .link-dark:hover {
            color: RGBA(26, 30, 33, var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(26, 30, 33, var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(26, 30, 33, var(--bs-link-underline-opacity, 1)) !important
        }

        .link-body-emphasis {
            color: RGBA(var(--bs-emphasis-color-rgb), var(--bs-link-opacity, 1)) !important;
            -webkit-text-decoration-color: RGBA(var(--bs-emphasis-color-rgb), var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: RGBA(var(--bs-emphasis-color-rgb), var(--bs-link-underline-opacity, 1)) !important
        }

        .link-body-emphasis:focus,
        .link-body-emphasis:hover {
            color: RGBA(var(--bs-emphasis-color-rgb), var(--bs-link-opacity, .75)) !important;
            -webkit-text-decoration-color: RGBA(var(--bs-emphasis-color-rgb), var(--bs-link-underline-opacity, 0.75)) !important;
            text-decoration-color: RGBA(var(--bs-emphasis-color-rgb), var(--bs-link-underline-opacity, 0.75)) !important
        }

        .focus-ring:focus {
            outline: 0;
            box-shadow: var(--bs-focus-ring-x, 0) var(--bs-focus-ring-y, 0) var(--bs-focus-ring-blur, 0) var(--bs-focus-ring-width) var(--bs-focus-ring-color)
        }

        .icon-link {
            display: inline-flex;
            gap: .375rem;
            align-items: center;
            -webkit-text-decoration-color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 0.5));
            text-decoration-color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 0.5));
            text-underline-offset: 0.25em;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden
        }

        .icon-link>.bi {
            flex-shrink: 0;
            width: 1em;
            height: 1em;
            fill: currentcolor;
            transition: .2s ease-in-out transform
        }

        @media (prefers-reduced-motion:reduce) {
            .icon-link>.bi {
                transition: none
            }
        }

        .icon-link-hover:focus-visible>.bi,
        .icon-link-hover:hover>.bi {
            transform: var(--bs-icon-link-transform, translate3d(.25em, 0, 0))
        }

        .ratio {
            position: relative;
            width: 100%
        }

        .ratio::before {
            display: block;
            padding-top: var(--bs-aspect-ratio);
            content: ""
        }

        .ratio>* {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%
        }

        .ratio-1x1 {
            --bs-aspect-ratio: 100%
        }

        .ratio-4x3 {
            --bs-aspect-ratio: 75%
        }

        .ratio-16x9 {
            --bs-aspect-ratio: 56.25%
        }

        .ratio-21x9 {
            --bs-aspect-ratio: 42.8571428571%
        }

        .fixed-top {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030
        }

        .fixed-bottom {
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1030
        }

        .sticky-top {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            z-index: 1020
        }

        .sticky-bottom {
            position: -webkit-sticky;
            position: sticky;
            bottom: 0;
            z-index: 1020
        }

        @media (min-width:576px) {
            .sticky-sm-top {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 1020
            }

            .sticky-sm-bottom {
                position: -webkit-sticky;
                position: sticky;
                bottom: 0;
                z-index: 1020
            }
        }

        @media (min-width:768px) {
            .sticky-md-top {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 1020
            }

            .sticky-md-bottom {
                position: -webkit-sticky;
                position: sticky;
                bottom: 0;
                z-index: 1020
            }
        }

        @media (min-width:992px) {
            .sticky-lg-top {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 1020
            }

            .sticky-lg-bottom {
                position: -webkit-sticky;
                position: sticky;
                bottom: 0;
                z-index: 1020
            }
        }

        @media (min-width:1200px) {
            .sticky-xl-top {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 1020
            }

            .sticky-xl-bottom {
                position: -webkit-sticky;
                position: sticky;
                bottom: 0;
                z-index: 1020
            }
        }

        @media (min-width:1400px) {
            .sticky-xxl-top {
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                z-index: 1020
            }

            .sticky-xxl-bottom {
                position: -webkit-sticky;
                position: sticky;
                bottom: 0;
                z-index: 1020
            }
        }

        .hstack {
            display: flex;
            flex-direction: row;
            align-items: center;
            align-self: stretch
        }

        .vstack {
            display: flex;
            flex: 1 1 auto;
            flex-direction: column;
            align-self: stretch
        }

        .visually-hidden,
        .visually-hidden-focusable:not(:focus):not(:focus-within) {
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important
        }

        .visually-hidden-focusable:not(:focus):not(:focus-within):not(caption),
        .visually-hidden:not(caption) {
            position: absolute !important
        }

        .stretched-link::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
            content: ""
        }

        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .vr {
            display: inline-block;
            align-self: stretch;
            width: 1px;
            min-height: 1em;
            background-color: currentcolor;
            opacity: .25
        }

        .align-baseline {
            vertical-align: baseline !important
        }

        .align-top {
            vertical-align: top !important
        }

        .align-middle {
            vertical-align: middle !important
        }

        .align-bottom {
            vertical-align: bottom !important
        }

        .align-text-bottom {
            vertical-align: text-bottom !important
        }

        .align-text-top {
            vertical-align: text-top !important
        }

        .float-start {
            float: left !important
        }

        .float-end {
            float: right !important
        }

        .float-none {
            float: none !important
        }

        .object-fit-contain {
            -o-object-fit: contain !important;
            object-fit: contain !important
        }

        .object-fit-cover {
            -o-object-fit: cover !important;
            object-fit: cover !important
        }

        .object-fit-fill {
            -o-object-fit: fill !important;
            object-fit: fill !important
        }

        .object-fit-scale {
            -o-object-fit: scale-down !important;
            object-fit: scale-down !important
        }

        .object-fit-none {
            -o-object-fit: none !important;
            object-fit: none !important
        }

        .opacity-0 {
            opacity: 0 !important
        }

        .opacity-25 {
            opacity: .25 !important
        }

        .opacity-50 {
            opacity: .5 !important
        }

        .opacity-75 {
            opacity: .75 !important
        }

        .opacity-100 {
            opacity: 1 !important
        }

        .overflow-auto {
            overflow: auto !important
        }

        .overflow-hidden {
            overflow: hidden !important
        }

        .overflow-visible {
            overflow: visible !important
        }

        .overflow-scroll {
            overflow: scroll !important
        }

        .overflow-x-auto {
            overflow-x: auto !important
        }

        .overflow-x-hidden {
            overflow-x: hidden !important
        }

        .overflow-x-visible {
            overflow-x: visible !important
        }

        .overflow-x-scroll {
            overflow-x: scroll !important
        }

        .overflow-y-auto {
            overflow-y: auto !important
        }

        .overflow-y-hidden {
            overflow-y: hidden !important
        }

        .overflow-y-visible {
            overflow-y: visible !important
        }

        .overflow-y-scroll {
            overflow-y: scroll !important
        }

        .d-inline {
            display: inline !important
        }

        .d-inline-block {
            display: inline-block !important
        }

        .d-block {
            display: block !important
        }

        .d-grid {
            display: grid !important
        }

        .d-inline-grid {
            display: inline-grid !important
        }

        .d-table {
            display: table !important
        }

        .d-table-row {
            display: table-row !important
        }

        .d-table-cell {
            display: table-cell !important
        }

        .d-flex {
            display: flex !important
        }

        .d-inline-flex {
            display: inline-flex !important
        }

        .d-none {
            display: none !important
        }

        .shadow {
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important
        }

        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important
        }

        .shadow-none {
            box-shadow: none !important
        }

        .focus-ring-primary {
            --bs-focus-ring-color: rgba(var(--bs-primary-rgb), var(--bs-focus-ring-opacity))
        }

        .focus-ring-secondary {
            --bs-focus-ring-color: rgba(var(--bs-secondary-rgb), var(--bs-focus-ring-opacity))
        }

        .focus-ring-success {
            --bs-focus-ring-color: rgba(var(--bs-success-rgb), var(--bs-focus-ring-opacity))
        }

        .focus-ring-info {
            --bs-focus-ring-color: rgba(var(--bs-info-rgb), var(--bs-focus-ring-opacity))
        }

        .focus-ring-warning {
            --bs-focus-ring-color: rgba(var(--bs-warning-rgb), var(--bs-focus-ring-opacity))
        }

        .focus-ring-danger {
            --bs-focus-ring-color: rgba(var(--bs-danger-rgb), var(--bs-focus-ring-opacity))
        }

        .focus-ring-light {
            --bs-focus-ring-color: rgba(var(--bs-light-rgb), var(--bs-focus-ring-opacity))
        }

        .focus-ring-dark {
            --bs-focus-ring-color: rgba(var(--bs-dark-rgb), var(--bs-focus-ring-opacity))
        }

        .position-static {
            position: static !important
        }

        .position-relative {
            position: relative !important
        }

        .position-absolute {
            position: absolute !important
        }

        .position-fixed {
            position: fixed !important
        }

        .position-sticky {
            position: -webkit-sticky !important;
            position: sticky !important
        }

        .top-0 {
            top: 0 !important
        }

        .top-50 {
            top: 50% !important
        }

        .top-100 {
            top: 100% !important
        }

        .bottom-0 {
            bottom: 0 !important
        }

        .bottom-50 {
            bottom: 50% !important
        }

        .bottom-100 {
            bottom: 100% !important
        }

        .start-0 {
            left: 0 !important
        }

        .start-50 {
            left: 50% !important
        }

        .start-100 {
            left: 100% !important
        }

        .end-0 {
            right: 0 !important
        }

        .end-50 {
            right: 50% !important
        }

        .end-100 {
            right: 100% !important
        }

        .translate-middle {
            transform: translate(-50%, -50%) !important
        }

        .translate-middle-x {
            transform: translateX(-50%) !important
        }

        .translate-middle-y {
            transform: translateY(-50%) !important
        }

        .border {
            border: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important
        }

        .border-0 {
            border: 0 !important
        }

        .border-top {
            border-top: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important
        }

        .border-top-0 {
            border-top: 0 !important
        }

        .border-end {
            border-right: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important
        }

        .border-end-0 {
            border-right: 0 !important
        }

        .border-bottom {
            border-bottom: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important
        }

        .border-bottom-0 {
            border-bottom: 0 !important
        }

        .border-start {
            border-left: var(--bs-border-width) var(--bs-border-style) var(--bs-border-color) !important
        }

        .border-start-0 {
            border-left: 0 !important
        }

        .border-primary {
            --bs-border-opacity: 1;
            border-color: rgba(var(--bs-primary-rgb), var(--bs-border-opacity)) !important
        }

        .border-secondary {
            --bs-border-opacity: 1;
            border-color: rgba(var(--bs-secondary-rgb), var(--bs-border-opacity)) !important
        }

        .border-success {
            --bs-border-opacity: 1;
            border-color: rgba(var(--bs-success-rgb), var(--bs-border-opacity)) !important
        }

        .border-info {
            --bs-border-opacity: 1;
            border-color: rgba(var(--bs-info-rgb), var(--bs-border-opacity)) !important
        }

        .border-warning {
            --bs-border-opacity: 1;
            border-color: rgba(var(--bs-warning-rgb), var(--bs-border-opacity)) !important
        }

        .border-danger {
            --bs-border-opacity: 1;
            border-color: rgba(var(--bs-danger-rgb), var(--bs-border-opacity)) !important
        }

        .border-light {
            --bs-border-opacity: 1;
            border-color: rgba(var(--bs-light-rgb), var(--bs-border-opacity)) !important
        }

        .border-dark {
            --bs-border-opacity: 1;
            border-color: rgba(var(--bs-dark-rgb), var(--bs-border-opacity)) !important
        }

        .border-black {
            --bs-border-opacity: 1;
            border-color: rgba(var(--bs-black-rgb), var(--bs-border-opacity)) !important
        }

        .border-white {
            --bs-border-opacity: 1;
            border-color: rgba(var(--bs-white-rgb), var(--bs-border-opacity)) !important
        }

        .border-primary-subtle {
            border-color: var(--bs-primary-border-subtle) !important
        }

        .border-secondary-subtle {
            border-color: var(--bs-secondary-border-subtle) !important
        }

        .border-success-subtle {
            border-color: var(--bs-success-border-subtle) !important
        }

        .border-info-subtle {
            border-color: var(--bs-info-border-subtle) !important
        }

        .border-warning-subtle {
            border-color: var(--bs-warning-border-subtle) !important
        }

        .border-danger-subtle {
            border-color: var(--bs-danger-border-subtle) !important
        }

        .border-light-subtle {
            border-color: var(--bs-light-border-subtle) !important
        }

        .border-dark-subtle {
            border-color: var(--bs-dark-border-subtle) !important
        }

        .border-1 {
            border-width: 1px !important
        }

        .border-2 {
            border-width: 2px !important
        }

        .border-3 {
            border-width: 3px !important
        }

        .border-4 {
            border-width: 4px !important
        }

        .border-5 {
            border-width: 5px !important
        }

        .border-opacity-10 {
            --bs-border-opacity: 0.1
        }

        .border-opacity-25 {
            --bs-border-opacity: 0.25
        }

        .border-opacity-50 {
            --bs-border-opacity: 0.5
        }

        .border-opacity-75 {
            --bs-border-opacity: 0.75
        }

        .border-opacity-100 {
            --bs-border-opacity: 1
        }

        .w-25 {
            width: 25% !important
        }

        .w-50 {
            width: 50% !important
        }

        .w-75 {
            width: 75% !important
        }

        .w-100 {
            width: 100% !important
        }

        .w-auto {
            width: auto !important
        }

        .mw-100 {
            max-width: 100% !important
        }

        .vw-100 {
            width: 100vw !important
        }

        .min-vw-100 {
            min-width: 100vw !important
        }

        .h-25 {
            height: 25% !important
        }

        .h-50 {
            height: 50% !important
        }

        .h-75 {
            height: 75% !important
        }

        .h-100 {
            height: 100% !important
        }

        .h-auto {
            height: auto !important
        }

        .mh-100 {
            max-height: 100% !important
        }

        .vh-100 {
            height: 100vh !important
        }

        .min-vh-100 {
            min-height: 100vh !important
        }

        .flex-fill {
            flex: 1 1 auto !important
        }

        .flex-row {
            flex-direction: row !important
        }

        .flex-column {
            flex-direction: column !important
        }

        .flex-row-reverse {
            flex-direction: row-reverse !important
        }

        .flex-column-reverse {
            flex-direction: column-reverse !important
        }

        .flex-grow-0 {
            flex-grow: 0 !important
        }

        .flex-grow-1 {
            flex-grow: 1 !important
        }

        .flex-shrink-0 {
            flex-shrink: 0 !important
        }

        .flex-shrink-1 {
            flex-shrink: 1 !important
        }

        .flex-wrap {
            flex-wrap: wrap !important
        }

        .flex-nowrap {
            flex-wrap: nowrap !important
        }

        .flex-wrap-reverse {
            flex-wrap: wrap-reverse !important
        }

        .justify-content-start {
            justify-content: flex-start !important
        }

        .justify-content-end {
            justify-content: flex-end !important
        }

        .justify-content-center {
            justify-content: center !important
        }

        .justify-content-between {
            justify-content: space-between !important
        }

        .justify-content-around {
            justify-content: space-around !important
        }

        .justify-content-evenly {
            justify-content: space-evenly !important
        }

        .align-items-start {
            align-items: flex-start !important
        }

        .align-items-end {
            align-items: flex-end !important
        }

        .align-items-center {
            align-items: center !important
        }

        .align-items-baseline {
            align-items: baseline !important
        }

        .align-items-stretch {
            align-items: stretch !important
        }

        .align-content-start {
            align-content: flex-start !important
        }

        .align-content-end {
            align-content: flex-end !important
        }

        .align-content-center {
            align-content: center !important
        }

        .align-content-between {
            align-content: space-between !important
        }

        .align-content-around {
            align-content: space-around !important
        }

        .align-content-stretch {
            align-content: stretch !important
        }

        .align-self-auto {
            align-self: auto !important
        }

        .align-self-start {
            align-self: flex-start !important
        }

        .align-self-end {
            align-self: flex-end !important
        }

        .align-self-center {
            align-self: center !important
        }

        .align-self-baseline {
            align-self: baseline !important
        }

        .align-self-stretch {
            align-self: stretch !important
        }

        .order-first {
            order: -1 !important
        }

        .order-0 {
            order: 0 !important
        }

        .order-1 {
            order: 1 !important
        }

        .order-2 {
            order: 2 !important
        }

        .order-3 {
            order: 3 !important
        }

        .order-4 {
            order: 4 !important
        }

        .order-5 {
            order: 5 !important
        }

        .order-last {
            order: 6 !important
        }

        .m-0 {
            margin: 0 !important
        }

        .m-1 {
            margin: .25rem !important
        }

        .m-2 {
            margin: .5rem !important
        }

        .m-3 {
            margin: 1rem !important
        }

        .m-4 {
            margin: 1.5rem !important
        }

        .m-5 {
            margin: 3rem !important
        }

        .m-auto {
            margin: auto !important
        }

        .mx-0 {
            margin-right: 0 !important;
            margin-left: 0 !important
        }

        .mx-1 {
            margin-right: .25rem !important;
            margin-left: .25rem !important
        }

        .mx-2 {
            margin-right: .5rem !important;
            margin-left: .5rem !important
        }

        .mx-3 {
            margin-right: 1rem !important;
            margin-left: 1rem !important
        }

        .mx-4 {
            margin-right: 1.5rem !important;
            margin-left: 1.5rem !important
        }

        .mx-5 {
            margin-right: 3rem !important;
            margin-left: 3rem !important
        }

        .mx-auto {
            margin-right: auto !important;
            margin-left: auto !important
        }

        .my-0 {
            margin-top: 0 !important;
            margin-bottom: 0 !important
        }

        .my-1 {
            margin-top: .25rem !important;
            margin-bottom: .25rem !important
        }

        .my-2 {
            margin-top: .5rem !important;
            margin-bottom: .5rem !important
        }

        .my-3 {
            margin-top: 1rem !important;
            margin-bottom: 1rem !important
        }

        .my-4 {
            margin-top: 1.5rem !important;
            margin-bottom: 1.5rem !important
        }

        .my-5 {
            margin-top: 3rem !important;
            margin-bottom: 3rem !important
        }

        .my-auto {
            margin-top: auto !important;
            margin-bottom: auto !important
        }

        .mt-0 {
            margin-top: 0 !important
        }

        .mt-1 {
            margin-top: .25rem !important
        }

        .mt-2 {
            margin-top: .5rem !important
        }

        .mt-3 {
            margin-top: 1rem !important
        }

        .mt-4 {
            margin-top: 1.5rem !important
        }

        .mt-5 {
            margin-top: 3rem !important
        }

        .mt-auto {
            margin-top: auto !important
        }

        .me-0 {
            margin-right: 0 !important
        }

        .me-1 {
            margin-right: .25rem !important
        }

        .me-2 {
            margin-right: .5rem !important
        }

        .me-3 {
            margin-right: 1rem !important
        }

        .me-4 {
            margin-right: 1.5rem !important
        }

        .me-5 {
            margin-right: 3rem !important
        }

        .me-auto {
            margin-right: auto !important
        }

        .mb-0 {
            margin-bottom: 0 !important
        }

        .mb-1 {
            margin-bottom: .25rem !important
        }

        .mb-2 {
            margin-bottom: .5rem !important
        }

        .mb-3 {
            margin-bottom: 1rem !important
        }

        .mb-4 {
            margin-bottom: 1.5rem !important
        }

        .mb-5 {
            margin-bottom: 3rem !important
        }

        .mb-auto {
            margin-bottom: auto !important
        }

        .ms-0 {
            margin-left: 0 !important
        }

        .ms-1 {
            margin-left: .25rem !important
        }

        .ms-2 {
            margin-left: .5rem !important
        }

        .ms-3 {
            margin-left: 1rem !important
        }

        .ms-4 {
            margin-left: 1.5rem !important
        }

        .ms-5 {
            margin-left: 3rem !important
        }

        .ms-auto {
            margin-left: auto !important
        }

        .p-0 {
            padding: 0 !important
        }

        .p-1 {
            padding: .25rem !important
        }

        .p-2 {
            padding: .5rem !important
        }

        .p-3 {
            padding: 1rem !important
        }

        .p-4 {
            padding: 1.5rem !important
        }

        .p-5 {
            padding: 3rem !important
        }

        .px-0 {
            padding-right: 0 !important;
            padding-left: 0 !important
        }

        .px-1 {
            padding-right: .25rem !important;
            padding-left: .25rem !important
        }

        .px-2 {
            padding-right: .5rem !important;
            padding-left: .5rem !important
        }

        .px-3 {
            padding-right: 1rem !important;
            padding-left: 1rem !important
        }

        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important
        }

        .px-5 {
            padding-right: 3rem !important;
            padding-left: 3rem !important
        }

        .py-0 {
            padding-top: 0 !important;
            padding-bottom: 0 !important
        }

        .py-1 {
            padding-top: .25rem !important;
            padding-bottom: .25rem !important
        }

        .py-2 {
            padding-top: .5rem !important;
            padding-bottom: .5rem !important
        }

        .py-3 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important
        }

        .py-4 {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important
        }

        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important
        }

        .pt-0 {
            padding-top: 0 !important
        }

        .pt-1 {
            padding-top: .25rem !important
        }

        .pt-2 {
            padding-top: .5rem !important
        }

        .pt-3 {
            padding-top: 1rem !important
        }

        .pt-4 {
            padding-top: 1.5rem !important
        }

        .pt-5 {
            padding-top: 3rem !important
        }

        .pe-0 {
            padding-right: 0 !important
        }

        .pe-1 {
            padding-right: .25rem !important
        }

        .pe-2 {
            padding-right: .5rem !important
        }

        .pe-3 {
            padding-right: 1rem !important
        }

        .pe-4 {
            padding-right: 1.5rem !important
        }

        .pe-5 {
            padding-right: 3rem !important
        }

        .pb-0 {
            padding-bottom: 0 !important
        }

        .pb-1 {
            padding-bottom: .25rem !important
        }

        .pb-2 {
            padding-bottom: .5rem !important
        }

        .pb-3 {
            padding-bottom: 1rem !important
        }

        .pb-4 {
            padding-bottom: 1.5rem !important
        }

        .pb-5 {
            padding-bottom: 3rem !important
        }

        .ps-0 {
            padding-left: 0 !important
        }

        .ps-1 {
            padding-left: .25rem !important
        }

        .ps-2 {
            padding-left: .5rem !important
        }

        .ps-3 {
            padding-left: 1rem !important
        }

        .ps-4 {
            padding-left: 1.5rem !important
        }

        .ps-5 {
            padding-left: 3rem !important
        }

        .gap-0 {
            gap: 0 !important
        }

        .gap-1 {
            gap: .25rem !important
        }

        .gap-2 {
            gap: .5rem !important
        }

        .gap-3 {
            gap: 1rem !important
        }

        .gap-4 {
            gap: 1.5rem !important
        }

        .gap-5 {
            gap: 3rem !important
        }

        .row-gap-0 {
            row-gap: 0 !important
        }

        .row-gap-1 {
            row-gap: .25rem !important
        }

        .row-gap-2 {
            row-gap: .5rem !important
        }

        .row-gap-3 {
            row-gap: 1rem !important
        }

        .row-gap-4 {
            row-gap: 1.5rem !important
        }

        .row-gap-5 {
            row-gap: 3rem !important
        }

        .column-gap-0 {
            -moz-column-gap: 0 !important;
            column-gap: 0 !important
        }

        .column-gap-1 {
            -moz-column-gap: 0.25rem !important;
            column-gap: .25rem !important
        }

        .column-gap-2 {
            -moz-column-gap: 0.5rem !important;
            column-gap: .5rem !important
        }

        .column-gap-3 {
            -moz-column-gap: 1rem !important;
            column-gap: 1rem !important
        }

        .column-gap-4 {
            -moz-column-gap: 1.5rem !important;
            column-gap: 1.5rem !important
        }

        .column-gap-5 {
            -moz-column-gap: 3rem !important;
            column-gap: 3rem !important
        }

        .font-monospace {
            font-family: var(--bs-font-monospace) !important
        }

        .fs-1 {
            font-size: calc(1.375rem + 1.5vw) !important
        }

        .fs-2 {
            font-size: calc(1.325rem + .9vw) !important
        }

        .fs-3 {
            font-size: calc(1.3rem + .6vw) !important
        }

        .fs-4 {
            font-size: calc(1.275rem + .3vw) !important
        }

        .fs-5 {
            font-size: 1.25rem !important
        }

        .fs-6 {
            font-size: 1rem !important
        }

        .fst-italic {
            font-style: italic !important
        }

        .fst-normal {
            font-style: normal !important
        }

        .fw-lighter {
            font-weight: lighter !important
        }

        .fw-light {
            font-weight: 300 !important
        }

        .fw-normal {
            font-weight: 400 !important
        }

        .fw-medium {
            font-weight: 500 !important
        }

        .fw-semibold {
            font-weight: 600 !important
        }

        .fw-bold {
            font-weight: 700 !important
        }

        .fw-bolder {
            font-weight: bolder !important
        }

        .lh-1 {
            line-height: 1 !important
        }

        .lh-sm {
            line-height: 1.25 !important
        }

        .lh-base {
            line-height: 1.5 !important
        }

        .lh-lg {
            line-height: 2 !important
        }

        .text-start {
            text-align: left !important
        }

        .text-end {
            text-align: right !important
        }

        .text-center {
            text-align: center !important
        }

        .text-decoration-none {
            text-decoration: none !important
        }

        .text-decoration-underline {
            text-decoration: underline !important
        }

        .text-decoration-line-through {
            text-decoration: line-through !important
        }

        .text-lowercase {
            text-transform: lowercase !important
        }

        .text-uppercase {
            text-transform: uppercase !important
        }

        .text-capitalize {
            text-transform: capitalize !important
        }

        .text-wrap {
            white-space: normal !important
        }

        .text-nowrap {
            white-space: nowrap !important
        }

        .text-break {
            word-wrap: break-word !important;
            word-break: break-word !important
        }

        .text-primary {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-primary-rgb), var(--bs-text-opacity)) !important
        }

        .text-secondary {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-secondary-rgb), var(--bs-text-opacity)) !important
        }

        .text-success {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-success-rgb), var(--bs-text-opacity)) !important
        }

        .text-info {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-info-rgb), var(--bs-text-opacity)) !important
        }

        .text-warning {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-warning-rgb), var(--bs-text-opacity)) !important
        }

        .text-danger {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-danger-rgb), var(--bs-text-opacity)) !important
        }

        .text-light {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-light-rgb), var(--bs-text-opacity)) !important
        }

        .text-dark {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-dark-rgb), var(--bs-text-opacity)) !important
        }

        .text-black {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-black-rgb), var(--bs-text-opacity)) !important
        }

        .text-white {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-white-rgb), var(--bs-text-opacity)) !important
        }

        .text-body {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-body-color-rgb), var(--bs-text-opacity)) !important
        }

        .text-muted {
            --bs-text-opacity: 1;
            color: var(--bs-secondary-color) !important
        }

        .text-black-50 {
            --bs-text-opacity: 1;
            color: rgba(0, 0, 0, .5) !important
        }

        .text-white-50 {
            --bs-text-opacity: 1;
            color: rgba(255, 255, 255, .5) !important
        }

        .text-body-secondary {
            --bs-text-opacity: 1;
            color: var(--bs-secondary-color) !important
        }

        .text-body-tertiary {
            --bs-text-opacity: 1;
            color: var(--bs-tertiary-color) !important
        }

        .text-body-emphasis {
            --bs-text-opacity: 1;
            color: var(--bs-emphasis-color) !important
        }

        .text-reset {
            --bs-text-opacity: 1;
            color: inherit !important
        }

        .text-opacity-25 {
            --bs-text-opacity: 0.25
        }

        .text-opacity-50 {
            --bs-text-opacity: 0.5
        }

        .text-opacity-75 {
            --bs-text-opacity: 0.75
        }

        .text-opacity-100 {
            --bs-text-opacity: 1
        }

        .text-primary-emphasis {
            color: var(--bs-primary-text-emphasis) !important
        }

        .text-secondary-emphasis {
            color: var(--bs-secondary-text-emphasis) !important
        }

        .text-success-emphasis {
            color: var(--bs-success-text-emphasis) !important
        }

        .text-info-emphasis {
            color: var(--bs-info-text-emphasis) !important
        }

        .text-warning-emphasis {
            color: var(--bs-warning-text-emphasis) !important
        }

        .text-danger-emphasis {
            color: var(--bs-danger-text-emphasis) !important
        }

        .text-light-emphasis {
            color: var(--bs-light-text-emphasis) !important
        }

        .text-dark-emphasis {
            color: var(--bs-dark-text-emphasis) !important
        }

        .link-opacity-10 {
            --bs-link-opacity: 0.1
        }

        .link-opacity-10-hover:hover {
            --bs-link-opacity: 0.1
        }

        .link-opacity-25 {
            --bs-link-opacity: 0.25
        }

        .link-opacity-25-hover:hover {
            --bs-link-opacity: 0.25
        }

        .link-opacity-50 {
            --bs-link-opacity: 0.5
        }

        .link-opacity-50-hover:hover {
            --bs-link-opacity: 0.5
        }

        .link-opacity-75 {
            --bs-link-opacity: 0.75
        }

        .link-opacity-75-hover:hover {
            --bs-link-opacity: 0.75
        }

        .link-opacity-100 {
            --bs-link-opacity: 1
        }

        .link-opacity-100-hover:hover {
            --bs-link-opacity: 1
        }

        .link-offset-1 {
            text-underline-offset: 0.125em !important
        }

        .link-offset-1-hover:hover {
            text-underline-offset: 0.125em !important
        }

        .link-offset-2 {
            text-underline-offset: 0.25em !important
        }

        .link-offset-2-hover:hover {
            text-underline-offset: 0.25em !important
        }

        .link-offset-3 {
            text-underline-offset: 0.375em !important
        }

        .link-offset-3-hover:hover {
            text-underline-offset: 0.375em !important
        }

        .link-underline-primary {
            --bs-link-underline-opacity: 1;
            -webkit-text-decoration-color: rgba(var(--bs-primary-rgb), var(--bs-link-underline-opacity)) !important;
            text-decoration-color: rgba(var(--bs-primary-rgb), var(--bs-link-underline-opacity)) !important
        }

        .link-underline-secondary {
            --bs-link-underline-opacity: 1;
            -webkit-text-decoration-color: rgba(var(--bs-secondary-rgb), var(--bs-link-underline-opacity)) !important;
            text-decoration-color: rgba(var(--bs-secondary-rgb), var(--bs-link-underline-opacity)) !important
        }

        .link-underline-success {
            --bs-link-underline-opacity: 1;
            -webkit-text-decoration-color: rgba(var(--bs-success-rgb), var(--bs-link-underline-opacity)) !important;
            text-decoration-color: rgba(var(--bs-success-rgb), var(--bs-link-underline-opacity)) !important
        }

        .link-underline-info {
            --bs-link-underline-opacity: 1;
            -webkit-text-decoration-color: rgba(var(--bs-info-rgb), var(--bs-link-underline-opacity)) !important;
            text-decoration-color: rgba(var(--bs-info-rgb), var(--bs-link-underline-opacity)) !important
        }

        .link-underline-warning {
            --bs-link-underline-opacity: 1;
            -webkit-text-decoration-color: rgba(var(--bs-warning-rgb), var(--bs-link-underline-opacity)) !important;
            text-decoration-color: rgba(var(--bs-warning-rgb), var(--bs-link-underline-opacity)) !important
        }

        .link-underline-danger {
            --bs-link-underline-opacity: 1;
            -webkit-text-decoration-color: rgba(var(--bs-danger-rgb), var(--bs-link-underline-opacity)) !important;
            text-decoration-color: rgba(var(--bs-danger-rgb), var(--bs-link-underline-opacity)) !important
        }

        .link-underline-light {
            --bs-link-underline-opacity: 1;
            -webkit-text-decoration-color: rgba(var(--bs-light-rgb), var(--bs-link-underline-opacity)) !important;
            text-decoration-color: rgba(var(--bs-light-rgb), var(--bs-link-underline-opacity)) !important
        }

        .link-underline-dark {
            --bs-link-underline-opacity: 1;
            -webkit-text-decoration-color: rgba(var(--bs-dark-rgb), var(--bs-link-underline-opacity)) !important;
            text-decoration-color: rgba(var(--bs-dark-rgb), var(--bs-link-underline-opacity)) !important
        }

        .link-underline {
            --bs-link-underline-opacity: 1;
            -webkit-text-decoration-color: rgba(var(--bs-link-color-rgb), var(--bs-link-underline-opacity, 1)) !important;
            text-decoration-color: rgba(var(--bs-link-color-rgb), var(--bs-link-underline-opacity, 1)) !important
        }

        .link-underline-opacity-0 {
            --bs-link-underline-opacity: 0
        }

        .link-underline-opacity-0-hover:hover {
            --bs-link-underline-opacity: 0
        }

        .link-underline-opacity-10 {
            --bs-link-underline-opacity: 0.1
        }

        .link-underline-opacity-10-hover:hover {
            --bs-link-underline-opacity: 0.1
        }

        .link-underline-opacity-25 {
            --bs-link-underline-opacity: 0.25
        }

        .link-underline-opacity-25-hover:hover {
            --bs-link-underline-opacity: 0.25
        }

        .link-underline-opacity-50 {
            --bs-link-underline-opacity: 0.5
        }

        .link-underline-opacity-50-hover:hover {
            --bs-link-underline-opacity: 0.5
        }

        .link-underline-opacity-75 {
            --bs-link-underline-opacity: 0.75
        }

        .link-underline-opacity-75-hover:hover {
            --bs-link-underline-opacity: 0.75
        }

        .link-underline-opacity-100 {
            --bs-link-underline-opacity: 1
        }

        .link-underline-opacity-100-hover:hover {
            --bs-link-underline-opacity: 1
        }

        .bg-primary {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-primary-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-secondary {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-secondary-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-success {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-success-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-info {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-info-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-warning {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-warning-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-danger {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-danger-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-light {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-dark {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-black {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-black-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-white {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-white-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-body {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-body-bg-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-transparent {
            --bs-bg-opacity: 1;
            background-color: transparent !important
        }

        .bg-body-secondary {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-secondary-bg-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-body-tertiary {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-tertiary-bg-rgb), var(--bs-bg-opacity)) !important
        }

        .bg-opacity-10 {
            --bs-bg-opacity: 0.1
        }

        .bg-opacity-25 {
            --bs-bg-opacity: 0.25
        }

        .bg-opacity-50 {
            --bs-bg-opacity: 0.5
        }

        .bg-opacity-75 {
            --bs-bg-opacity: 0.75
        }

        .bg-opacity-100 {
            --bs-bg-opacity: 1
        }

        .bg-primary-subtle {
            background-color: var(--bs-primary-bg-subtle) !important
        }

        .bg-secondary-subtle {
            background-color: var(--bs-secondary-bg-subtle) !important
        }

        .bg-success-subtle {
            background-color: var(--bs-success-bg-subtle) !important
        }

        .bg-info-subtle {
            background-color: var(--bs-info-bg-subtle) !important
        }

        .bg-warning-subtle {
            background-color: var(--bs-warning-bg-subtle) !important
        }

        .bg-danger-subtle {
            background-color: var(--bs-danger-bg-subtle) !important
        }

        .bg-light-subtle {
            background-color: var(--bs-light-bg-subtle) !important
        }

        .bg-dark-subtle {
            background-color: var(--bs-dark-bg-subtle) !important
        }

        .bg-gradient {
            background-image: var(--bs-gradient) !important
        }

        .user-select-all {
            -webkit-user-select: all !important;
            -moz-user-select: all !important;
            user-select: all !important
        }

        .user-select-auto {
            -webkit-user-select: auto !important;
            -moz-user-select: auto !important;
            user-select: auto !important
        }

        .user-select-none {
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            user-select: none !important
        }

        .pe-none {
            pointer-events: none !important
        }

        .pe-auto {
            pointer-events: auto !important
        }

        .rounded {
            border-radius: var(--bs-border-radius) !important
        }

        .rounded-0 {
            border-radius: 0 !important
        }

        .rounded-1 {
            border-radius: var(--bs-border-radius-sm) !important
        }

        .rounded-2 {
            border-radius: var(--bs-border-radius) !important
        }

        .rounded-3 {
            border-radius: var(--bs-border-radius-lg) !important
        }

        .rounded-4 {
            border-radius: var(--bs-border-radius-xl) !important
        }

        .rounded-5 {
            border-radius: var(--bs-border-radius-xxl) !important
        }

        .rounded-circle {
            border-radius: 50% !important
        }

        .rounded-pill {
            border-radius: var(--bs-border-radius-pill) !important
        }

        .rounded-top {
            border-top-left-radius: var(--bs-border-radius) !important;
            border-top-right-radius: var(--bs-border-radius) !important
        }

        .rounded-top-0 {
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important
        }

        .rounded-top-1 {
            border-top-left-radius: var(--bs-border-radius-sm) !important;
            border-top-right-radius: var(--bs-border-radius-sm) !important
        }

        .rounded-top-2 {
            border-top-left-radius: var(--bs-border-radius) !important;
            border-top-right-radius: var(--bs-border-radius) !important
        }

        .rounded-top-3 {
            border-top-left-radius: var(--bs-border-radius-lg) !important;
            border-top-right-radius: var(--bs-border-radius-lg) !important
        }

        .rounded-top-4 {
            border-top-left-radius: var(--bs-border-radius-xl) !important;
            border-top-right-radius: var(--bs-border-radius-xl) !important
        }

        .rounded-top-5 {
            border-top-left-radius: var(--bs-border-radius-xxl) !important;
            border-top-right-radius: var(--bs-border-radius-xxl) !important
        }

        .rounded-top-circle {
            border-top-left-radius: 50% !important;
            border-top-right-radius: 50% !important
        }

        .rounded-top-pill {
            border-top-left-radius: var(--bs-border-radius-pill) !important;
            border-top-right-radius: var(--bs-border-radius-pill) !important
        }

        .rounded-end {
            border-top-right-radius: var(--bs-border-radius) !important;
            border-bottom-right-radius: var(--bs-border-radius) !important
        }

        .rounded-end-0 {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important
        }

        .rounded-end-1 {
            border-top-right-radius: var(--bs-border-radius-sm) !important;
            border-bottom-right-radius: var(--bs-border-radius-sm) !important
        }

        .rounded-end-2 {
            border-top-right-radius: var(--bs-border-radius) !important;
            border-bottom-right-radius: var(--bs-border-radius) !important
        }

        .rounded-end-3 {
            border-top-right-radius: var(--bs-border-radius-lg) !important;
            border-bottom-right-radius: var(--bs-border-radius-lg) !important
        }

        .rounded-end-4 {
            border-top-right-radius: var(--bs-border-radius-xl) !important;
            border-bottom-right-radius: var(--bs-border-radius-xl) !important
        }

        .rounded-end-5 {
            border-top-right-radius: var(--bs-border-radius-xxl) !important;
            border-bottom-right-radius: var(--bs-border-radius-xxl) !important
        }

        .rounded-end-circle {
            border-top-right-radius: 50% !important;
            border-bottom-right-radius: 50% !important
        }

        .rounded-end-pill {
            border-top-right-radius: var(--bs-border-radius-pill) !important;
            border-bottom-right-radius: var(--bs-border-radius-pill) !important
        }

        .rounded-bottom {
            border-bottom-right-radius: var(--bs-border-radius) !important;
            border-bottom-left-radius: var(--bs-border-radius) !important
        }

        .rounded-bottom-0 {
            border-bottom-right-radius: 0 !important;
            border-bottom-left-radius: 0 !important
        }

        .rounded-bottom-1 {
            border-bottom-right-radius: var(--bs-border-radius-sm) !important;
            border-bottom-left-radius: var(--bs-border-radius-sm) !important
        }

        .rounded-bottom-2 {
            border-bottom-right-radius: var(--bs-border-radius) !important;
            border-bottom-left-radius: var(--bs-border-radius) !important
        }

        .rounded-bottom-3 {
            border-bottom-right-radius: var(--bs-border-radius-lg) !important;
            border-bottom-left-radius: var(--bs-border-radius-lg) !important
        }

        .rounded-bottom-4 {
            border-bottom-right-radius: var(--bs-border-radius-xl) !important;
            border-bottom-left-radius: var(--bs-border-radius-xl) !important
        }

        .rounded-bottom-5 {
            border-bottom-right-radius: var(--bs-border-radius-xxl) !important;
            border-bottom-left-radius: var(--bs-border-radius-xxl) !important
        }

        .rounded-bottom-circle {
            border-bottom-right-radius: 50% !important;
            border-bottom-left-radius: 50% !important
        }

        .rounded-bottom-pill {
            border-bottom-right-radius: var(--bs-border-radius-pill) !important;
            border-bottom-left-radius: var(--bs-border-radius-pill) !important
        }

        .rounded-start {
            border-bottom-left-radius: var(--bs-border-radius) !important;
            border-top-left-radius: var(--bs-border-radius) !important
        }

        .rounded-start-0 {
            border-bottom-left-radius: 0 !important;
            border-top-left-radius: 0 !important
        }

        .rounded-start-1 {
            border-bottom-left-radius: var(--bs-border-radius-sm) !important;
            border-top-left-radius: var(--bs-border-radius-sm) !important
        }

        .rounded-start-2 {
            border-bottom-left-radius: var(--bs-border-radius) !important;
            border-top-left-radius: var(--bs-border-radius) !important
        }

        .rounded-start-3 {
            border-bottom-left-radius: var(--bs-border-radius-lg) !important;
            border-top-left-radius: var(--bs-border-radius-lg) !important
        }

        .rounded-start-4 {
            border-bottom-left-radius: var(--bs-border-radius-xl) !important;
            border-top-left-radius: var(--bs-border-radius-xl) !important
        }

        .rounded-start-5 {
            border-bottom-left-radius: var(--bs-border-radius-xxl) !important;
            border-top-left-radius: var(--bs-border-radius-xxl) !important
        }

        .rounded-start-circle {
            border-bottom-left-radius: 50% !important;
            border-top-left-radius: 50% !important
        }

        .rounded-start-pill {
            border-bottom-left-radius: var(--bs-border-radius-pill) !important;
            border-top-left-radius: var(--bs-border-radius-pill) !important
        }

        .visible {
            visibility: visible !important
        }

        .invisible {
            visibility: hidden !important
        }

        .z-n1 {
            z-index: -1 !important
        }

        .z-0 {
            z-index: 0 !important
        }

        .z-1 {
            z-index: 1 !important
        }

        .z-2 {
            z-index: 2 !important
        }

        .z-3 {
            z-index: 3 !important
        }

        @media (min-width:576px) {
            .float-sm-start {
                float: left !important
            }

            .float-sm-end {
                float: right !important
            }

            .float-sm-none {
                float: none !important
            }

            .object-fit-sm-contain {
                -o-object-fit: contain !important;
                object-fit: contain !important
            }

            .object-fit-sm-cover {
                -o-object-fit: cover !important;
                object-fit: cover !important
            }

            .object-fit-sm-fill {
                -o-object-fit: fill !important;
                object-fit: fill !important
            }

            .object-fit-sm-scale {
                -o-object-fit: scale-down !important;
                object-fit: scale-down !important
            }

            .object-fit-sm-none {
                -o-object-fit: none !important;
                object-fit: none !important
            }

            .d-sm-inline {
                display: inline !important
            }

            .d-sm-inline-block {
                display: inline-block !important
            }

            .d-sm-block {
                display: block !important
            }

            .d-sm-grid {
                display: grid !important
            }

            .d-sm-inline-grid {
                display: inline-grid !important
            }

            .d-sm-table {
                display: table !important
            }

            .d-sm-table-row {
                display: table-row !important
            }

            .d-sm-table-cell {
                display: table-cell !important
            }

            .d-sm-flex {
                display: flex !important
            }

            .d-sm-inline-flex {
                display: inline-flex !important
            }

            .d-sm-none {
                display: none !important
            }

            .flex-sm-fill {
                flex: 1 1 auto !important
            }

            .flex-sm-row {
                flex-direction: row !important
            }

            .flex-sm-column {
                flex-direction: column !important
            }

            .flex-sm-row-reverse {
                flex-direction: row-reverse !important
            }

            .flex-sm-column-reverse {
                flex-direction: column-reverse !important
            }

            .flex-sm-grow-0 {
                flex-grow: 0 !important
            }

            .flex-sm-grow-1 {
                flex-grow: 1 !important
            }

            .flex-sm-shrink-0 {
                flex-shrink: 0 !important
            }

            .flex-sm-shrink-1 {
                flex-shrink: 1 !important
            }

            .flex-sm-wrap {
                flex-wrap: wrap !important
            }

            .flex-sm-nowrap {
                flex-wrap: nowrap !important
            }

            .flex-sm-wrap-reverse {
                flex-wrap: wrap-reverse !important
            }

            .justify-content-sm-start {
                justify-content: flex-start !important
            }

            .justify-content-sm-end {
                justify-content: flex-end !important
            }

            .justify-content-sm-center {
                justify-content: center !important
            }

            .justify-content-sm-between {
                justify-content: space-between !important
            }

            .justify-content-sm-around {
                justify-content: space-around !important
            }

            .justify-content-sm-evenly {
                justify-content: space-evenly !important
            }

            .align-items-sm-start {
                align-items: flex-start !important
            }

            .align-items-sm-end {
                align-items: flex-end !important
            }

            .align-items-sm-center {
                align-items: center !important
            }

            .align-items-sm-baseline {
                align-items: baseline !important
            }

            .align-items-sm-stretch {
                align-items: stretch !important
            }

            .align-content-sm-start {
                align-content: flex-start !important
            }

            .align-content-sm-end {
                align-content: flex-end !important
            }

            .align-content-sm-center {
                align-content: center !important
            }

            .align-content-sm-between {
                align-content: space-between !important
            }

            .align-content-sm-around {
                align-content: space-around !important
            }

            .align-content-sm-stretch {
                align-content: stretch !important
            }

            .align-self-sm-auto {
                align-self: auto !important
            }

            .align-self-sm-start {
                align-self: flex-start !important
            }

            .align-self-sm-end {
                align-self: flex-end !important
            }

            .align-self-sm-center {
                align-self: center !important
            }

            .align-self-sm-baseline {
                align-self: baseline !important
            }

            .align-self-sm-stretch {
                align-self: stretch !important
            }

            .order-sm-first {
                order: -1 !important
            }

            .order-sm-0 {
                order: 0 !important
            }

            .order-sm-1 {
                order: 1 !important
            }

            .order-sm-2 {
                order: 2 !important
            }

            .order-sm-3 {
                order: 3 !important
            }

            .order-sm-4 {
                order: 4 !important
            }

            .order-sm-5 {
                order: 5 !important
            }

            .order-sm-last {
                order: 6 !important
            }

            .m-sm-0 {
                margin: 0 !important
            }

            .m-sm-1 {
                margin: .25rem !important
            }

            .m-sm-2 {
                margin: .5rem !important
            }

            .m-sm-3 {
                margin: 1rem !important
            }

            .m-sm-4 {
                margin: 1.5rem !important
            }

            .m-sm-5 {
                margin: 3rem !important
            }

            .m-sm-auto {
                margin: auto !important
            }

            .mx-sm-0 {
                margin-right: 0 !important;
                margin-left: 0 !important
            }

            .mx-sm-1 {
                margin-right: .25rem !important;
                margin-left: .25rem !important
            }

            .mx-sm-2 {
                margin-right: .5rem !important;
                margin-left: .5rem !important
            }

            .mx-sm-3 {
                margin-right: 1rem !important;
                margin-left: 1rem !important
            }

            .mx-sm-4 {
                margin-right: 1.5rem !important;
                margin-left: 1.5rem !important
            }

            .mx-sm-5 {
                margin-right: 3rem !important;
                margin-left: 3rem !important
            }

            .mx-sm-auto {
                margin-right: auto !important;
                margin-left: auto !important
            }

            .my-sm-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important
            }

            .my-sm-1 {
                margin-top: .25rem !important;
                margin-bottom: .25rem !important
            }

            .my-sm-2 {
                margin-top: .5rem !important;
                margin-bottom: .5rem !important
            }

            .my-sm-3 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important
            }

            .my-sm-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important
            }

            .my-sm-5 {
                margin-top: 3rem !important;
                margin-bottom: 3rem !important
            }

            .my-sm-auto {
                margin-top: auto !important;
                margin-bottom: auto !important
            }

            .mt-sm-0 {
                margin-top: 0 !important
            }

            .mt-sm-1 {
                margin-top: .25rem !important
            }

            .mt-sm-2 {
                margin-top: .5rem !important
            }

            .mt-sm-3 {
                margin-top: 1rem !important
            }

            .mt-sm-4 {
                margin-top: 1.5rem !important
            }

            .mt-sm-5 {
                margin-top: 3rem !important
            }

            .mt-sm-auto {
                margin-top: auto !important
            }

            .me-sm-0 {
                margin-right: 0 !important
            }

            .me-sm-1 {
                margin-right: .25rem !important
            }

            .me-sm-2 {
                margin-right: .5rem !important
            }

            .me-sm-3 {
                margin-right: 1rem !important
            }

            .me-sm-4 {
                margin-right: 1.5rem !important
            }

            .me-sm-5 {
                margin-right: 3rem !important
            }

            .me-sm-auto {
                margin-right: auto !important
            }

            .mb-sm-0 {
                margin-bottom: 0 !important
            }

            .mb-sm-1 {
                margin-bottom: .25rem !important
            }

            .mb-sm-2 {
                margin-bottom: .5rem !important
            }

            .mb-sm-3 {
                margin-bottom: 1rem !important
            }

            .mb-sm-4 {
                margin-bottom: 1.5rem !important
            }

            .mb-sm-5 {
                margin-bottom: 3rem !important
            }

            .mb-sm-auto {
                margin-bottom: auto !important
            }

            .ms-sm-0 {
                margin-left: 0 !important
            }

            .ms-sm-1 {
                margin-left: .25rem !important
            }

            .ms-sm-2 {
                margin-left: .5rem !important
            }

            .ms-sm-3 {
                margin-left: 1rem !important
            }

            .ms-sm-4 {
                margin-left: 1.5rem !important
            }

            .ms-sm-5 {
                margin-left: 3rem !important
            }

            .ms-sm-auto {
                margin-left: auto !important
            }

            .p-sm-0 {
                padding: 0 !important
            }

            .p-sm-1 {
                padding: .25rem !important
            }

            .p-sm-2 {
                padding: .5rem !important
            }

            .p-sm-3 {
                padding: 1rem !important
            }

            .p-sm-4 {
                padding: 1.5rem !important
            }

            .p-sm-5 {
                padding: 3rem !important
            }

            .px-sm-0 {
                padding-right: 0 !important;
                padding-left: 0 !important
            }

            .px-sm-1 {
                padding-right: .25rem !important;
                padding-left: .25rem !important
            }

            .px-sm-2 {
                padding-right: .5rem !important;
                padding-left: .5rem !important
            }

            .px-sm-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important
            }

            .px-sm-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important
            }

            .px-sm-5 {
                padding-right: 3rem !important;
                padding-left: 3rem !important
            }

            .py-sm-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important
            }

            .py-sm-1 {
                padding-top: .25rem !important;
                padding-bottom: .25rem !important
            }

            .py-sm-2 {
                padding-top: .5rem !important;
                padding-bottom: .5rem !important
            }

            .py-sm-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important
            }

            .py-sm-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important
            }

            .py-sm-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important
            }

            .pt-sm-0 {
                padding-top: 0 !important
            }

            .pt-sm-1 {
                padding-top: .25rem !important
            }

            .pt-sm-2 {
                padding-top: .5rem !important
            }

            .pt-sm-3 {
                padding-top: 1rem !important
            }

            .pt-sm-4 {
                padding-top: 1.5rem !important
            }

            .pt-sm-5 {
                padding-top: 3rem !important
            }

            .pe-sm-0 {
                padding-right: 0 !important
            }

            .pe-sm-1 {
                padding-right: .25rem !important
            }

            .pe-sm-2 {
                padding-right: .5rem !important
            }

            .pe-sm-3 {
                padding-right: 1rem !important
            }

            .pe-sm-4 {
                padding-right: 1.5rem !important
            }

            .pe-sm-5 {
                padding-right: 3rem !important
            }

            .pb-sm-0 {
                padding-bottom: 0 !important
            }

            .pb-sm-1 {
                padding-bottom: .25rem !important
            }

            .pb-sm-2 {
                padding-bottom: .5rem !important
            }

            .pb-sm-3 {
                padding-bottom: 1rem !important
            }

            .pb-sm-4 {
                padding-bottom: 1.5rem !important
            }

            .pb-sm-5 {
                padding-bottom: 3rem !important
            }

            .ps-sm-0 {
                padding-left: 0 !important
            }

            .ps-sm-1 {
                padding-left: .25rem !important
            }

            .ps-sm-2 {
                padding-left: .5rem !important
            }

            .ps-sm-3 {
                padding-left: 1rem !important
            }

            .ps-sm-4 {
                padding-left: 1.5rem !important
            }

            .ps-sm-5 {
                padding-left: 3rem !important
            }

            .gap-sm-0 {
                gap: 0 !important
            }

            .gap-sm-1 {
                gap: .25rem !important
            }

            .gap-sm-2 {
                gap: .5rem !important
            }

            .gap-sm-3 {
                gap: 1rem !important
            }

            .gap-sm-4 {
                gap: 1.5rem !important
            }

            .gap-sm-5 {
                gap: 3rem !important
            }

            .row-gap-sm-0 {
                row-gap: 0 !important
            }

            .row-gap-sm-1 {
                row-gap: .25rem !important
            }

            .row-gap-sm-2 {
                row-gap: .5rem !important
            }

            .row-gap-sm-3 {
                row-gap: 1rem !important
            }

            .row-gap-sm-4 {
                row-gap: 1.5rem !important
            }

            .row-gap-sm-5 {
                row-gap: 3rem !important
            }

            .column-gap-sm-0 {
                -moz-column-gap: 0 !important;
                column-gap: 0 !important
            }

            .column-gap-sm-1 {
                -moz-column-gap: 0.25rem !important;
                column-gap: .25rem !important
            }

            .column-gap-sm-2 {
                -moz-column-gap: 0.5rem !important;
                column-gap: .5rem !important
            }

            .column-gap-sm-3 {
                -moz-column-gap: 1rem !important;
                column-gap: 1rem !important
            }

            .column-gap-sm-4 {
                -moz-column-gap: 1.5rem !important;
                column-gap: 1.5rem !important
            }

            .column-gap-sm-5 {
                -moz-column-gap: 3rem !important;
                column-gap: 3rem !important
            }

            .text-sm-start {
                text-align: left !important
            }

            .text-sm-end {
                text-align: right !important
            }

            .text-sm-center {
                text-align: center !important
            }
        }

        @media (min-width:768px) {
            .float-md-start {
                float: left !important
            }

            .float-md-end {
                float: right !important
            }

            .float-md-none {
                float: none !important
            }

            .object-fit-md-contain {
                -o-object-fit: contain !important;
                object-fit: contain !important
            }

            .object-fit-md-cover {
                -o-object-fit: cover !important;
                object-fit: cover !important
            }

            .object-fit-md-fill {
                -o-object-fit: fill !important;
                object-fit: fill !important
            }

            .object-fit-md-scale {
                -o-object-fit: scale-down !important;
                object-fit: scale-down !important
            }

            .object-fit-md-none {
                -o-object-fit: none !important;
                object-fit: none !important
            }

            .d-md-inline {
                display: inline !important
            }

            .d-md-inline-block {
                display: inline-block !important
            }

            .d-md-block {
                display: block !important
            }

            .d-md-grid {
                display: grid !important
            }

            .d-md-inline-grid {
                display: inline-grid !important
            }

            .d-md-table {
                display: table !important
            }

            .d-md-table-row {
                display: table-row !important
            }

            .d-md-table-cell {
                display: table-cell !important
            }

            .d-md-flex {
                display: flex !important
            }

            .d-md-inline-flex {
                display: inline-flex !important
            }

            .d-md-none {
                display: none !important
            }

            .flex-md-fill {
                flex: 1 1 auto !important
            }

            .flex-md-row {
                flex-direction: row !important
            }

            .flex-md-column {
                flex-direction: column !important
            }

            .flex-md-row-reverse {
                flex-direction: row-reverse !important
            }

            .flex-md-column-reverse {
                flex-direction: column-reverse !important
            }

            .flex-md-grow-0 {
                flex-grow: 0 !important
            }

            .flex-md-grow-1 {
                flex-grow: 1 !important
            }

            .flex-md-shrink-0 {
                flex-shrink: 0 !important
            }

            .flex-md-shrink-1 {
                flex-shrink: 1 !important
            }

            .flex-md-wrap {
                flex-wrap: wrap !important
            }

            .flex-md-nowrap {
                flex-wrap: nowrap !important
            }

            .flex-md-wrap-reverse {
                flex-wrap: wrap-reverse !important
            }

            .justify-content-md-start {
                justify-content: flex-start !important
            }

            .justify-content-md-end {
                justify-content: flex-end !important
            }

            .justify-content-md-center {
                justify-content: center !important
            }

            .justify-content-md-between {
                justify-content: space-between !important
            }

            .justify-content-md-around {
                justify-content: space-around !important
            }

            .justify-content-md-evenly {
                justify-content: space-evenly !important
            }

            .align-items-md-start {
                align-items: flex-start !important
            }

            .align-items-md-end {
                align-items: flex-end !important
            }

            .align-items-md-center {
                align-items: center !important
            }

            .align-items-md-baseline {
                align-items: baseline !important
            }

            .align-items-md-stretch {
                align-items: stretch !important
            }

            .align-content-md-start {
                align-content: flex-start !important
            }

            .align-content-md-end {
                align-content: flex-end !important
            }

            .align-content-md-center {
                align-content: center !important
            }

            .align-content-md-between {
                align-content: space-between !important
            }

            .align-content-md-around {
                align-content: space-around !important
            }

            .align-content-md-stretch {
                align-content: stretch !important
            }

            .align-self-md-auto {
                align-self: auto !important
            }

            .align-self-md-start {
                align-self: flex-start !important
            }

            .align-self-md-end {
                align-self: flex-end !important
            }

            .align-self-md-center {
                align-self: center !important
            }

            .align-self-md-baseline {
                align-self: baseline !important
            }

            .align-self-md-stretch {
                align-self: stretch !important
            }

            .order-md-first {
                order: -1 !important
            }

            .order-md-0 {
                order: 0 !important
            }

            .order-md-1 {
                order: 1 !important
            }

            .order-md-2 {
                order: 2 !important
            }

            .order-md-3 {
                order: 3 !important
            }

            .order-md-4 {
                order: 4 !important
            }

            .order-md-5 {
                order: 5 !important
            }

            .order-md-last {
                order: 6 !important
            }

            .m-md-0 {
                margin: 0 !important
            }

            .m-md-1 {
                margin: .25rem !important
            }

            .m-md-2 {
                margin: .5rem !important
            }

            .m-md-3 {
                margin: 1rem !important
            }

            .m-md-4 {
                margin: 1.5rem !important
            }

            .m-md-5 {
                margin: 3rem !important
            }

            .m-md-auto {
                margin: auto !important
            }

            .mx-md-0 {
                margin-right: 0 !important;
                margin-left: 0 !important
            }

            .mx-md-1 {
                margin-right: .25rem !important;
                margin-left: .25rem !important
            }

            .mx-md-2 {
                margin-right: .5rem !important;
                margin-left: .5rem !important
            }

            .mx-md-3 {
                margin-right: 1rem !important;
                margin-left: 1rem !important
            }

            .mx-md-4 {
                margin-right: 1.5rem !important;
                margin-left: 1.5rem !important
            }

            .mx-md-5 {
                margin-right: 3rem !important;
                margin-left: 3rem !important
            }

            .mx-md-auto {
                margin-right: auto !important;
                margin-left: auto !important
            }

            .my-md-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important
            }

            .my-md-1 {
                margin-top: .25rem !important;
                margin-bottom: .25rem !important
            }

            .my-md-2 {
                margin-top: .5rem !important;
                margin-bottom: .5rem !important
            }

            .my-md-3 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important
            }

            .my-md-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important
            }

            .my-md-5 {
                margin-top: 3rem !important;
                margin-bottom: 3rem !important
            }

            .my-md-auto {
                margin-top: auto !important;
                margin-bottom: auto !important
            }

            .mt-md-0 {
                margin-top: 0 !important
            }

            .mt-md-1 {
                margin-top: .25rem !important
            }

            .mt-md-2 {
                margin-top: .5rem !important
            }

            .mt-md-3 {
                margin-top: 1rem !important
            }

            .mt-md-4 {
                margin-top: 1.5rem !important
            }

            .mt-md-5 {
                margin-top: 3rem !important
            }

            .mt-md-auto {
                margin-top: auto !important
            }

            .me-md-0 {
                margin-right: 0 !important
            }

            .me-md-1 {
                margin-right: .25rem !important
            }

            .me-md-2 {
                margin-right: .5rem !important
            }

            .me-md-3 {
                margin-right: 1rem !important
            }

            .me-md-4 {
                margin-right: 1.5rem !important
            }

            .me-md-5 {
                margin-right: 3rem !important
            }

            .me-md-auto {
                margin-right: auto !important
            }

            .mb-md-0 {
                margin-bottom: 0 !important
            }

            .mb-md-1 {
                margin-bottom: .25rem !important
            }

            .mb-md-2 {
                margin-bottom: .5rem !important
            }

            .mb-md-3 {
                margin-bottom: 1rem !important
            }

            .mb-md-4 {
                margin-bottom: 1.5rem !important
            }

            .mb-md-5 {
                margin-bottom: 3rem !important
            }

            .mb-md-auto {
                margin-bottom: auto !important
            }

            .ms-md-0 {
                margin-left: 0 !important
            }

            .ms-md-1 {
                margin-left: .25rem !important
            }

            .ms-md-2 {
                margin-left: .5rem !important
            }

            .ms-md-3 {
                margin-left: 1rem !important
            }

            .ms-md-4 {
                margin-left: 1.5rem !important
            }

            .ms-md-5 {
                margin-left: 3rem !important
            }

            .ms-md-auto {
                margin-left: auto !important
            }

            .p-md-0 {
                padding: 0 !important
            }

            .p-md-1 {
                padding: .25rem !important
            }

            .p-md-2 {
                padding: .5rem !important
            }

            .p-md-3 {
                padding: 1rem !important
            }

            .p-md-4 {
                padding: 1.5rem !important
            }

            .p-md-5 {
                padding: 3rem !important
            }

            .px-md-0 {
                padding-right: 0 !important;
                padding-left: 0 !important
            }

            .px-md-1 {
                padding-right: .25rem !important;
                padding-left: .25rem !important
            }

            .px-md-2 {
                padding-right: .5rem !important;
                padding-left: .5rem !important
            }

            .px-md-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important
            }

            .px-md-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important
            }

            .px-md-5 {
                padding-right: 3rem !important;
                padding-left: 3rem !important
            }

            .py-md-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important
            }

            .py-md-1 {
                padding-top: .25rem !important;
                padding-bottom: .25rem !important
            }

            .py-md-2 {
                padding-top: .5rem !important;
                padding-bottom: .5rem !important
            }

            .py-md-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important
            }

            .py-md-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important
            }

            .py-md-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important
            }

            .pt-md-0 {
                padding-top: 0 !important
            }

            .pt-md-1 {
                padding-top: .25rem !important
            }

            .pt-md-2 {
                padding-top: .5rem !important
            }

            .pt-md-3 {
                padding-top: 1rem !important
            }

            .pt-md-4 {
                padding-top: 1.5rem !important
            }

            .pt-md-5 {
                padding-top: 3rem !important
            }

            .pe-md-0 {
                padding-right: 0 !important
            }

            .pe-md-1 {
                padding-right: .25rem !important
            }

            .pe-md-2 {
                padding-right: .5rem !important
            }

            .pe-md-3 {
                padding-right: 1rem !important
            }

            .pe-md-4 {
                padding-right: 1.5rem !important
            }

            .pe-md-5 {
                padding-right: 3rem !important
            }

            .pb-md-0 {
                padding-bottom: 0 !important
            }

            .pb-md-1 {
                padding-bottom: .25rem !important
            }

            .pb-md-2 {
                padding-bottom: .5rem !important
            }

            .pb-md-3 {
                padding-bottom: 1rem !important
            }

            .pb-md-4 {
                padding-bottom: 1.5rem !important
            }

            .pb-md-5 {
                padding-bottom: 3rem !important
            }

            .ps-md-0 {
                padding-left: 0 !important
            }

            .ps-md-1 {
                padding-left: .25rem !important
            }

            .ps-md-2 {
                padding-left: .5rem !important
            }

            .ps-md-3 {
                padding-left: 1rem !important
            }

            .ps-md-4 {
                padding-left: 1.5rem !important
            }

            .ps-md-5 {
                padding-left: 3rem !important
            }

            .gap-md-0 {
                gap: 0 !important
            }

            .gap-md-1 {
                gap: .25rem !important
            }

            .gap-md-2 {
                gap: .5rem !important
            }

            .gap-md-3 {
                gap: 1rem !important
            }

            .gap-md-4 {
                gap: 1.5rem !important
            }

            .gap-md-5 {
                gap: 3rem !important
            }

            .row-gap-md-0 {
                row-gap: 0 !important
            }

            .row-gap-md-1 {
                row-gap: .25rem !important
            }

            .row-gap-md-2 {
                row-gap: .5rem !important
            }

            .row-gap-md-3 {
                row-gap: 1rem !important
            }

            .row-gap-md-4 {
                row-gap: 1.5rem !important
            }

            .row-gap-md-5 {
                row-gap: 3rem !important
            }

            .column-gap-md-0 {
                -moz-column-gap: 0 !important;
                column-gap: 0 !important
            }

            .column-gap-md-1 {
                -moz-column-gap: 0.25rem !important;
                column-gap: .25rem !important
            }

            .column-gap-md-2 {
                -moz-column-gap: 0.5rem !important;
                column-gap: .5rem !important
            }

            .column-gap-md-3 {
                -moz-column-gap: 1rem !important;
                column-gap: 1rem !important
            }

            .column-gap-md-4 {
                -moz-column-gap: 1.5rem !important;
                column-gap: 1.5rem !important
            }

            .column-gap-md-5 {
                -moz-column-gap: 3rem !important;
                column-gap: 3rem !important
            }

            .text-md-start {
                text-align: left !important
            }

            .text-md-end {
                text-align: right !important
            }

            .text-md-center {
                text-align: center !important
            }
        }

        @media (min-width:992px) {
            .float-lg-start {
                float: left !important
            }

            .float-lg-end {
                float: right !important
            }

            .float-lg-none {
                float: none !important
            }

            .object-fit-lg-contain {
                -o-object-fit: contain !important;
                object-fit: contain !important
            }

            .object-fit-lg-cover {
                -o-object-fit: cover !important;
                object-fit: cover !important
            }

            .object-fit-lg-fill {
                -o-object-fit: fill !important;
                object-fit: fill !important
            }

            .object-fit-lg-scale {
                -o-object-fit: scale-down !important;
                object-fit: scale-down !important
            }

            .object-fit-lg-none {
                -o-object-fit: none !important;
                object-fit: none !important
            }

            .d-lg-inline {
                display: inline !important
            }

            .d-lg-inline-block {
                display: inline-block !important
            }

            .d-lg-block {
                display: block !important
            }

            .d-lg-grid {
                display: grid !important
            }

            .d-lg-inline-grid {
                display: inline-grid !important
            }

            .d-lg-table {
                display: table !important
            }

            .d-lg-table-row {
                display: table-row !important
            }

            .d-lg-table-cell {
                display: table-cell !important
            }

            .d-lg-flex {
                display: flex !important
            }

            .d-lg-inline-flex {
                display: inline-flex !important
            }

            .d-lg-none {
                display: none !important
            }

            .flex-lg-fill {
                flex: 1 1 auto !important
            }

            .flex-lg-row {
                flex-direction: row !important
            }

            .flex-lg-column {
                flex-direction: column !important
            }

            .flex-lg-row-reverse {
                flex-direction: row-reverse !important
            }

            .flex-lg-column-reverse {
                flex-direction: column-reverse !important
            }

            .flex-lg-grow-0 {
                flex-grow: 0 !important
            }

            .flex-lg-grow-1 {
                flex-grow: 1 !important
            }

            .flex-lg-shrink-0 {
                flex-shrink: 0 !important
            }

            .flex-lg-shrink-1 {
                flex-shrink: 1 !important
            }

            .flex-lg-wrap {
                flex-wrap: wrap !important
            }

            .flex-lg-nowrap {
                flex-wrap: nowrap !important
            }

            .flex-lg-wrap-reverse {
                flex-wrap: wrap-reverse !important
            }

            .justify-content-lg-start {
                justify-content: flex-start !important
            }

            .justify-content-lg-end {
                justify-content: flex-end !important
            }

            .justify-content-lg-center {
                justify-content: center !important
            }

            .justify-content-lg-between {
                justify-content: space-between !important
            }

            .justify-content-lg-around {
                justify-content: space-around !important
            }

            .justify-content-lg-evenly {
                justify-content: space-evenly !important
            }

            .align-items-lg-start {
                align-items: flex-start !important
            }

            .align-items-lg-end {
                align-items: flex-end !important
            }

            .align-items-lg-center {
                align-items: center !important
            }

            .align-items-lg-baseline {
                align-items: baseline !important
            }

            .align-items-lg-stretch {
                align-items: stretch !important
            }

            .align-content-lg-start {
                align-content: flex-start !important
            }

            .align-content-lg-end {
                align-content: flex-end !important
            }

            .align-content-lg-center {
                align-content: center !important
            }

            .align-content-lg-between {
                align-content: space-between !important
            }

            .align-content-lg-around {
                align-content: space-around !important
            }

            .align-content-lg-stretch {
                align-content: stretch !important
            }

            .align-self-lg-auto {
                align-self: auto !important
            }

            .align-self-lg-start {
                align-self: flex-start !important
            }

            .align-self-lg-end {
                align-self: flex-end !important
            }

            .align-self-lg-center {
                align-self: center !important
            }

            .align-self-lg-baseline {
                align-self: baseline !important
            }

            .align-self-lg-stretch {
                align-self: stretch !important
            }

            .order-lg-first {
                order: -1 !important
            }

            .order-lg-0 {
                order: 0 !important
            }

            .order-lg-1 {
                order: 1 !important
            }

            .order-lg-2 {
                order: 2 !important
            }

            .order-lg-3 {
                order: 3 !important
            }

            .order-lg-4 {
                order: 4 !important
            }

            .order-lg-5 {
                order: 5 !important
            }

            .order-lg-last {
                order: 6 !important
            }

            .m-lg-0 {
                margin: 0 !important
            }

            .m-lg-1 {
                margin: .25rem !important
            }

            .m-lg-2 {
                margin: .5rem !important
            }

            .m-lg-3 {
                margin: 1rem !important
            }

            .m-lg-4 {
                margin: 1.5rem !important
            }

            .m-lg-5 {
                margin: 3rem !important
            }

            .m-lg-auto {
                margin: auto !important
            }

            .mx-lg-0 {
                margin-right: 0 !important;
                margin-left: 0 !important
            }

            .mx-lg-1 {
                margin-right: .25rem !important;
                margin-left: .25rem !important
            }

            .mx-lg-2 {
                margin-right: .5rem !important;
                margin-left: .5rem !important
            }

            .mx-lg-3 {
                margin-right: 1rem !important;
                margin-left: 1rem !important
            }

            .mx-lg-4 {
                margin-right: 1.5rem !important;
                margin-left: 1.5rem !important
            }

            .mx-lg-5 {
                margin-right: 3rem !important;
                margin-left: 3rem !important
            }

            .mx-lg-auto {
                margin-right: auto !important;
                margin-left: auto !important
            }

            .my-lg-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important
            }

            .my-lg-1 {
                margin-top: .25rem !important;
                margin-bottom: .25rem !important
            }

            .my-lg-2 {
                margin-top: .5rem !important;
                margin-bottom: .5rem !important
            }

            .my-lg-3 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important
            }

            .my-lg-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important
            }

            .my-lg-5 {
                margin-top: 3rem !important;
                margin-bottom: 3rem !important
            }

            .my-lg-auto {
                margin-top: auto !important;
                margin-bottom: auto !important
            }

            .mt-lg-0 {
                margin-top: 0 !important
            }

            .mt-lg-1 {
                margin-top: .25rem !important
            }

            .mt-lg-2 {
                margin-top: .5rem !important
            }

            .mt-lg-3 {
                margin-top: 1rem !important
            }

            .mt-lg-4 {
                margin-top: 1.5rem !important
            }

            .mt-lg-5 {
                margin-top: 3rem !important
            }

            .mt-lg-auto {
                margin-top: auto !important
            }

            .me-lg-0 {
                margin-right: 0 !important
            }

            .me-lg-1 {
                margin-right: .25rem !important
            }

            .me-lg-2 {
                margin-right: .5rem !important
            }

            .me-lg-3 {
                margin-right: 1rem !important
            }

            .me-lg-4 {
                margin-right: 1.5rem !important
            }

            .me-lg-5 {
                margin-right: 3rem !important
            }

            .me-lg-auto {
                margin-right: auto !important
            }

            .mb-lg-0 {
                margin-bottom: 0 !important
            }

            .mb-lg-1 {
                margin-bottom: .25rem !important
            }

            .mb-lg-2 {
                margin-bottom: .5rem !important
            }

            .mb-lg-3 {
                margin-bottom: 1rem !important
            }

            .mb-lg-4 {
                margin-bottom: 1.5rem !important
            }

            .mb-lg-5 {
                margin-bottom: 3rem !important
            }

            .mb-lg-auto {
                margin-bottom: auto !important
            }

            .ms-lg-0 {
                margin-left: 0 !important
            }

            .ms-lg-1 {
                margin-left: .25rem !important
            }

            .ms-lg-2 {
                margin-left: .5rem !important
            }

            .ms-lg-3 {
                margin-left: 1rem !important
            }

            .ms-lg-4 {
                margin-left: 1.5rem !important
            }

            .ms-lg-5 {
                margin-left: 3rem !important
            }

            .ms-lg-auto {
                margin-left: auto !important
            }

            .p-lg-0 {
                padding: 0 !important
            }

            .p-lg-1 {
                padding: .25rem !important
            }

            .p-lg-2 {
                padding: .5rem !important
            }

            .p-lg-3 {
                padding: 1rem !important
            }

            .p-lg-4 {
                padding: 1.5rem !important
            }

            .p-lg-5 {
                padding: 3rem !important
            }

            .px-lg-0 {
                padding-right: 0 !important;
                padding-left: 0 !important
            }

            .px-lg-1 {
                padding-right: .25rem !important;
                padding-left: .25rem !important
            }

            .px-lg-2 {
                padding-right: .5rem !important;
                padding-left: .5rem !important
            }

            .px-lg-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important
            }

            .px-lg-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important
            }

            .px-lg-5 {
                padding-right: 3rem !important;
                padding-left: 3rem !important
            }

            .py-lg-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important
            }

            .py-lg-1 {
                padding-top: .25rem !important;
                padding-bottom: .25rem !important
            }

            .py-lg-2 {
                padding-top: .5rem !important;
                padding-bottom: .5rem !important
            }

            .py-lg-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important
            }

            .py-lg-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important
            }

            .py-lg-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important
            }

            .pt-lg-0 {
                padding-top: 0 !important
            }

            .pt-lg-1 {
                padding-top: .25rem !important
            }

            .pt-lg-2 {
                padding-top: .5rem !important
            }

            .pt-lg-3 {
                padding-top: 1rem !important
            }

            .pt-lg-4 {
                padding-top: 1.5rem !important
            }

            .pt-lg-5 {
                padding-top: 3rem !important
            }

            .pe-lg-0 {
                padding-right: 0 !important
            }

            .pe-lg-1 {
                padding-right: .25rem !important
            }

            .pe-lg-2 {
                padding-right: .5rem !important
            }

            .pe-lg-3 {
                padding-right: 1rem !important
            }

            .pe-lg-4 {
                padding-right: 1.5rem !important
            }

            .pe-lg-5 {
                padding-right: 3rem !important
            }

            .pb-lg-0 {
                padding-bottom: 0 !important
            }

            .pb-lg-1 {
                padding-bottom: .25rem !important
            }

            .pb-lg-2 {
                padding-bottom: .5rem !important
            }

            .pb-lg-3 {
                padding-bottom: 1rem !important
            }

            .pb-lg-4 {
                padding-bottom: 1.5rem !important
            }

            .pb-lg-5 {
                padding-bottom: 3rem !important
            }

            .ps-lg-0 {
                padding-left: 0 !important
            }

            .ps-lg-1 {
                padding-left: .25rem !important
            }

            .ps-lg-2 {
                padding-left: .5rem !important
            }

            .ps-lg-3 {
                padding-left: 1rem !important
            }

            .ps-lg-4 {
                padding-left: 1.5rem !important
            }

            .ps-lg-5 {
                padding-left: 3rem !important
            }

            .gap-lg-0 {
                gap: 0 !important
            }

            .gap-lg-1 {
                gap: .25rem !important
            }

            .gap-lg-2 {
                gap: .5rem !important
            }

            .gap-lg-3 {
                gap: 1rem !important
            }

            .gap-lg-4 {
                gap: 1.5rem !important
            }

            .gap-lg-5 {
                gap: 3rem !important
            }

            .row-gap-lg-0 {
                row-gap: 0 !important
            }

            .row-gap-lg-1 {
                row-gap: .25rem !important
            }

            .row-gap-lg-2 {
                row-gap: .5rem !important
            }

            .row-gap-lg-3 {
                row-gap: 1rem !important
            }

            .row-gap-lg-4 {
                row-gap: 1.5rem !important
            }

            .row-gap-lg-5 {
                row-gap: 3rem !important
            }

            .column-gap-lg-0 {
                -moz-column-gap: 0 !important;
                column-gap: 0 !important
            }

            .column-gap-lg-1 {
                -moz-column-gap: 0.25rem !important;
                column-gap: .25rem !important
            }

            .column-gap-lg-2 {
                -moz-column-gap: 0.5rem !important;
                column-gap: .5rem !important
            }

            .column-gap-lg-3 {
                -moz-column-gap: 1rem !important;
                column-gap: 1rem !important
            }

            .column-gap-lg-4 {
                -moz-column-gap: 1.5rem !important;
                column-gap: 1.5rem !important
            }

            .column-gap-lg-5 {
                -moz-column-gap: 3rem !important;
                column-gap: 3rem !important
            }

            .text-lg-start {
                text-align: left !important
            }

            .text-lg-end {
                text-align: right !important
            }

            .text-lg-center {
                text-align: center !important
            }
        }

        @media (min-width:1200px) {
            .float-xl-start {
                float: left !important
            }

            .float-xl-end {
                float: right !important
            }

            .float-xl-none {
                float: none !important
            }

            .object-fit-xl-contain {
                -o-object-fit: contain !important;
                object-fit: contain !important
            }

            .object-fit-xl-cover {
                -o-object-fit: cover !important;
                object-fit: cover !important
            }

            .object-fit-xl-fill {
                -o-object-fit: fill !important;
                object-fit: fill !important
            }

            .object-fit-xl-scale {
                -o-object-fit: scale-down !important;
                object-fit: scale-down !important
            }

            .object-fit-xl-none {
                -o-object-fit: none !important;
                object-fit: none !important
            }

            .d-xl-inline {
                display: inline !important
            }

            .d-xl-inline-block {
                display: inline-block !important
            }

            .d-xl-block {
                display: block !important
            }

            .d-xl-grid {
                display: grid !important
            }

            .d-xl-inline-grid {
                display: inline-grid !important
            }

            .d-xl-table {
                display: table !important
            }

            .d-xl-table-row {
                display: table-row !important
            }

            .d-xl-table-cell {
                display: table-cell !important
            }

            .d-xl-flex {
                display: flex !important
            }

            .d-xl-inline-flex {
                display: inline-flex !important
            }

            .d-xl-none {
                display: none !important
            }

            .flex-xl-fill {
                flex: 1 1 auto !important
            }

            .flex-xl-row {
                flex-direction: row !important
            }

            .flex-xl-column {
                flex-direction: column !important
            }

            .flex-xl-row-reverse {
                flex-direction: row-reverse !important
            }

            .flex-xl-column-reverse {
                flex-direction: column-reverse !important
            }

            .flex-xl-grow-0 {
                flex-grow: 0 !important
            }

            .flex-xl-grow-1 {
                flex-grow: 1 !important
            }

            .flex-xl-shrink-0 {
                flex-shrink: 0 !important
            }

            .flex-xl-shrink-1 {
                flex-shrink: 1 !important
            }

            .flex-xl-wrap {
                flex-wrap: wrap !important
            }

            .flex-xl-nowrap {
                flex-wrap: nowrap !important
            }

            .flex-xl-wrap-reverse {
                flex-wrap: wrap-reverse !important
            }

            .justify-content-xl-start {
                justify-content: flex-start !important
            }

            .justify-content-xl-end {
                justify-content: flex-end !important
            }

            .justify-content-xl-center {
                justify-content: center !important
            }

            .justify-content-xl-between {
                justify-content: space-between !important
            }

            .justify-content-xl-around {
                justify-content: space-around !important
            }

            .justify-content-xl-evenly {
                justify-content: space-evenly !important
            }

            .align-items-xl-start {
                align-items: flex-start !important
            }

            .align-items-xl-end {
                align-items: flex-end !important
            }

            .align-items-xl-center {
                align-items: center !important
            }

            .align-items-xl-baseline {
                align-items: baseline !important
            }

            .align-items-xl-stretch {
                align-items: stretch !important
            }

            .align-content-xl-start {
                align-content: flex-start !important
            }

            .align-content-xl-end {
                align-content: flex-end !important
            }

            .align-content-xl-center {
                align-content: center !important
            }

            .align-content-xl-between {
                align-content: space-between !important
            }

            .align-content-xl-around {
                align-content: space-around !important
            }

            .align-content-xl-stretch {
                align-content: stretch !important
            }

            .align-self-xl-auto {
                align-self: auto !important
            }

            .align-self-xl-start {
                align-self: flex-start !important
            }

            .align-self-xl-end {
                align-self: flex-end !important
            }

            .align-self-xl-center {
                align-self: center !important
            }

            .align-self-xl-baseline {
                align-self: baseline !important
            }

            .align-self-xl-stretch {
                align-self: stretch !important
            }

            .order-xl-first {
                order: -1 !important
            }

            .order-xl-0 {
                order: 0 !important
            }

            .order-xl-1 {
                order: 1 !important
            }

            .order-xl-2 {
                order: 2 !important
            }

            .order-xl-3 {
                order: 3 !important
            }

            .order-xl-4 {
                order: 4 !important
            }

            .order-xl-5 {
                order: 5 !important
            }

            .order-xl-last {
                order: 6 !important
            }

            .m-xl-0 {
                margin: 0 !important
            }

            .m-xl-1 {
                margin: .25rem !important
            }

            .m-xl-2 {
                margin: .5rem !important
            }

            .m-xl-3 {
                margin: 1rem !important
            }

            .m-xl-4 {
                margin: 1.5rem !important
            }

            .m-xl-5 {
                margin: 3rem !important
            }

            .m-xl-auto {
                margin: auto !important
            }

            .mx-xl-0 {
                margin-right: 0 !important;
                margin-left: 0 !important
            }

            .mx-xl-1 {
                margin-right: .25rem !important;
                margin-left: .25rem !important
            }

            .mx-xl-2 {
                margin-right: .5rem !important;
                margin-left: .5rem !important
            }

            .mx-xl-3 {
                margin-right: 1rem !important;
                margin-left: 1rem !important
            }

            .mx-xl-4 {
                margin-right: 1.5rem !important;
                margin-left: 1.5rem !important
            }

            .mx-xl-5 {
                margin-right: 3rem !important;
                margin-left: 3rem !important
            }

            .mx-xl-auto {
                margin-right: auto !important;
                margin-left: auto !important
            }

            .my-xl-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important
            }

            .my-xl-1 {
                margin-top: .25rem !important;
                margin-bottom: .25rem !important
            }

            .my-xl-2 {
                margin-top: .5rem !important;
                margin-bottom: .5rem !important
            }

            .my-xl-3 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important
            }

            .my-xl-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important
            }

            .my-xl-5 {
                margin-top: 3rem !important;
                margin-bottom: 3rem !important
            }

            .my-xl-auto {
                margin-top: auto !important;
                margin-bottom: auto !important
            }

            .mt-xl-0 {
                margin-top: 0 !important
            }

            .mt-xl-1 {
                margin-top: .25rem !important
            }

            .mt-xl-2 {
                margin-top: .5rem !important
            }

            .mt-xl-3 {
                margin-top: 1rem !important
            }

            .mt-xl-4 {
                margin-top: 1.5rem !important
            }

            .mt-xl-5 {
                margin-top: 3rem !important
            }

            .mt-xl-auto {
                margin-top: auto !important
            }

            .me-xl-0 {
                margin-right: 0 !important
            }

            .me-xl-1 {
                margin-right: .25rem !important
            }

            .me-xl-2 {
                margin-right: .5rem !important
            }

            .me-xl-3 {
                margin-right: 1rem !important
            }

            .me-xl-4 {
                margin-right: 1.5rem !important
            }

            .me-xl-5 {
                margin-right: 3rem !important
            }

            .me-xl-auto {
                margin-right: auto !important
            }

            .mb-xl-0 {
                margin-bottom: 0 !important
            }

            .mb-xl-1 {
                margin-bottom: .25rem !important
            }

            .mb-xl-2 {
                margin-bottom: .5rem !important
            }

            .mb-xl-3 {
                margin-bottom: 1rem !important
            }

            .mb-xl-4 {
                margin-bottom: 1.5rem !important
            }

            .mb-xl-5 {
                margin-bottom: 3rem !important
            }

            .mb-xl-auto {
                margin-bottom: auto !important
            }

            .ms-xl-0 {
                margin-left: 0 !important
            }

            .ms-xl-1 {
                margin-left: .25rem !important
            }

            .ms-xl-2 {
                margin-left: .5rem !important
            }

            .ms-xl-3 {
                margin-left: 1rem !important
            }

            .ms-xl-4 {
                margin-left: 1.5rem !important
            }

            .ms-xl-5 {
                margin-left: 3rem !important
            }

            .ms-xl-auto {
                margin-left: auto !important
            }

            .p-xl-0 {
                padding: 0 !important
            }

            .p-xl-1 {
                padding: .25rem !important
            }

            .p-xl-2 {
                padding: .5rem !important
            }

            .p-xl-3 {
                padding: 1rem !important
            }

            .p-xl-4 {
                padding: 1.5rem !important
            }

            .p-xl-5 {
                padding: 3rem !important
            }

            .px-xl-0 {
                padding-right: 0 !important;
                padding-left: 0 !important
            }

            .px-xl-1 {
                padding-right: .25rem !important;
                padding-left: .25rem !important
            }

            .px-xl-2 {
                padding-right: .5rem !important;
                padding-left: .5rem !important
            }

            .px-xl-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important
            }

            .px-xl-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important
            }

            .px-xl-5 {
                padding-right: 3rem !important;
                padding-left: 3rem !important
            }

            .py-xl-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important
            }

            .py-xl-1 {
                padding-top: .25rem !important;
                padding-bottom: .25rem !important
            }

            .py-xl-2 {
                padding-top: .5rem !important;
                padding-bottom: .5rem !important
            }

            .py-xl-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important
            }

            .py-xl-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important
            }

            .py-xl-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important
            }

            .pt-xl-0 {
                padding-top: 0 !important
            }

            .pt-xl-1 {
                padding-top: .25rem !important
            }

            .pt-xl-2 {
                padding-top: .5rem !important
            }

            .pt-xl-3 {
                padding-top: 1rem !important
            }

            .pt-xl-4 {
                padding-top: 1.5rem !important
            }

            .pt-xl-5 {
                padding-top: 3rem !important
            }

            .pe-xl-0 {
                padding-right: 0 !important
            }

            .pe-xl-1 {
                padding-right: .25rem !important
            }

            .pe-xl-2 {
                padding-right: .5rem !important
            }

            .pe-xl-3 {
                padding-right: 1rem !important
            }

            .pe-xl-4 {
                padding-right: 1.5rem !important
            }

            .pe-xl-5 {
                padding-right: 3rem !important
            }

            .pb-xl-0 {
                padding-bottom: 0 !important
            }

            .pb-xl-1 {
                padding-bottom: .25rem !important
            }

            .pb-xl-2 {
                padding-bottom: .5rem !important
            }

            .pb-xl-3 {
                padding-bottom: 1rem !important
            }

            .pb-xl-4 {
                padding-bottom: 1.5rem !important
            }

            .pb-xl-5 {
                padding-bottom: 3rem !important
            }

            .ps-xl-0 {
                padding-left: 0 !important
            }

            .ps-xl-1 {
                padding-left: .25rem !important
            }

            .ps-xl-2 {
                padding-left: .5rem !important
            }

            .ps-xl-3 {
                padding-left: 1rem !important
            }

            .ps-xl-4 {
                padding-left: 1.5rem !important
            }

            .ps-xl-5 {
                padding-left: 3rem !important
            }

            .gap-xl-0 {
                gap: 0 !important
            }

            .gap-xl-1 {
                gap: .25rem !important
            }

            .gap-xl-2 {
                gap: .5rem !important
            }

            .gap-xl-3 {
                gap: 1rem !important
            }

            .gap-xl-4 {
                gap: 1.5rem !important
            }

            .gap-xl-5 {
                gap: 3rem !important
            }

            .row-gap-xl-0 {
                row-gap: 0 !important
            }

            .row-gap-xl-1 {
                row-gap: .25rem !important
            }

            .row-gap-xl-2 {
                row-gap: .5rem !important
            }

            .row-gap-xl-3 {
                row-gap: 1rem !important
            }

            .row-gap-xl-4 {
                row-gap: 1.5rem !important
            }

            .row-gap-xl-5 {
                row-gap: 3rem !important
            }

            .column-gap-xl-0 {
                -moz-column-gap: 0 !important;
                column-gap: 0 !important
            }

            .column-gap-xl-1 {
                -moz-column-gap: 0.25rem !important;
                column-gap: .25rem !important
            }

            .column-gap-xl-2 {
                -moz-column-gap: 0.5rem !important;
                column-gap: .5rem !important
            }

            .column-gap-xl-3 {
                -moz-column-gap: 1rem !important;
                column-gap: 1rem !important
            }

            .column-gap-xl-4 {
                -moz-column-gap: 1.5rem !important;
                column-gap: 1.5rem !important
            }

            .column-gap-xl-5 {
                -moz-column-gap: 3rem !important;
                column-gap: 3rem !important
            }

            .text-xl-start {
                text-align: left !important
            }

            .text-xl-end {
                text-align: right !important
            }

            .text-xl-center {
                text-align: center !important
            }
        }

        @media (min-width:1400px) {
            .float-xxl-start {
                float: left !important
            }

            .float-xxl-end {
                float: right !important
            }

            .float-xxl-none {
                float: none !important
            }

            .object-fit-xxl-contain {
                -o-object-fit: contain !important;
                object-fit: contain !important
            }

            .object-fit-xxl-cover {
                -o-object-fit: cover !important;
                object-fit: cover !important
            }

            .object-fit-xxl-fill {
                -o-object-fit: fill !important;
                object-fit: fill !important
            }

            .object-fit-xxl-scale {
                -o-object-fit: scale-down !important;
                object-fit: scale-down !important
            }

            .object-fit-xxl-none {
                -o-object-fit: none !important;
                object-fit: none !important
            }

            .d-xxl-inline {
                display: inline !important
            }

            .d-xxl-inline-block {
                display: inline-block !important
            }

            .d-xxl-block {
                display: block !important
            }

            .d-xxl-grid {
                display: grid !important
            }

            .d-xxl-inline-grid {
                display: inline-grid !important
            }

            .d-xxl-table {
                display: table !important
            }

            .d-xxl-table-row {
                display: table-row !important
            }

            .d-xxl-table-cell {
                display: table-cell !important
            }

            .d-xxl-flex {
                display: flex !important
            }

            .d-xxl-inline-flex {
                display: inline-flex !important
            }

            .d-xxl-none {
                display: none !important
            }

            .flex-xxl-fill {
                flex: 1 1 auto !important
            }

            .flex-xxl-row {
                flex-direction: row !important
            }

            .flex-xxl-column {
                flex-direction: column !important
            }

            .flex-xxl-row-reverse {
                flex-direction: row-reverse !important
            }

            .flex-xxl-column-reverse {
                flex-direction: column-reverse !important
            }

            .flex-xxl-grow-0 {
                flex-grow: 0 !important
            }

            .flex-xxl-grow-1 {
                flex-grow: 1 !important
            }

            .flex-xxl-shrink-0 {
                flex-shrink: 0 !important
            }

            .flex-xxl-shrink-1 {
                flex-shrink: 1 !important
            }

            .flex-xxl-wrap {
                flex-wrap: wrap !important
            }

            .flex-xxl-nowrap {
                flex-wrap: nowrap !important
            }

            .flex-xxl-wrap-reverse {
                flex-wrap: wrap-reverse !important
            }

            .justify-content-xxl-start {
                justify-content: flex-start !important
            }

            .justify-content-xxl-end {
                justify-content: flex-end !important
            }

            .justify-content-xxl-center {
                justify-content: center !important
            }

            .justify-content-xxl-between {
                justify-content: space-between !important
            }

            .justify-content-xxl-around {
                justify-content: space-around !important
            }

            .justify-content-xxl-evenly {
                justify-content: space-evenly !important
            }

            .align-items-xxl-start {
                align-items: flex-start !important
            }

            .align-items-xxl-end {
                align-items: flex-end !important
            }

            .align-items-xxl-center {
                align-items: center !important
            }

            .align-items-xxl-baseline {
                align-items: baseline !important
            }

            .align-items-xxl-stretch {
                align-items: stretch !important
            }

            .align-content-xxl-start {
                align-content: flex-start !important
            }

            .align-content-xxl-end {
                align-content: flex-end !important
            }

            .align-content-xxl-center {
                align-content: center !important
            }

            .align-content-xxl-between {
                align-content: space-between !important
            }

            .align-content-xxl-around {
                align-content: space-around !important
            }

            .align-content-xxl-stretch {
                align-content: stretch !important
            }

            .align-self-xxl-auto {
                align-self: auto !important
            }

            .align-self-xxl-start {
                align-self: flex-start !important
            }

            .align-self-xxl-end {
                align-self: flex-end !important
            }

            .align-self-xxl-center {
                align-self: center !important
            }

            .align-self-xxl-baseline {
                align-self: baseline !important
            }

            .align-self-xxl-stretch {
                align-self: stretch !important
            }

            .order-xxl-first {
                order: -1 !important
            }

            .order-xxl-0 {
                order: 0 !important
            }

            .order-xxl-1 {
                order: 1 !important
            }

            .order-xxl-2 {
                order: 2 !important
            }

            .order-xxl-3 {
                order: 3 !important
            }

            .order-xxl-4 {
                order: 4 !important
            }

            .order-xxl-5 {
                order: 5 !important
            }

            .order-xxl-last {
                order: 6 !important
            }

            .m-xxl-0 {
                margin: 0 !important
            }

            .m-xxl-1 {
                margin: .25rem !important
            }

            .m-xxl-2 {
                margin: .5rem !important
            }

            .m-xxl-3 {
                margin: 1rem !important
            }

            .m-xxl-4 {
                margin: 1.5rem !important
            }

            .m-xxl-5 {
                margin: 3rem !important
            }

            .m-xxl-auto {
                margin: auto !important
            }

            .mx-xxl-0 {
                margin-right: 0 !important;
                margin-left: 0 !important
            }

            .mx-xxl-1 {
                margin-right: .25rem !important;
                margin-left: .25rem !important
            }

            .mx-xxl-2 {
                margin-right: .5rem !important;
                margin-left: .5rem !important
            }

            .mx-xxl-3 {
                margin-right: 1rem !important;
                margin-left: 1rem !important
            }

            .mx-xxl-4 {
                margin-right: 1.5rem !important;
                margin-left: 1.5rem !important
            }

            .mx-xxl-5 {
                margin-right: 3rem !important;
                margin-left: 3rem !important
            }

            .mx-xxl-auto {
                margin-right: auto !important;
                margin-left: auto !important
            }

            .my-xxl-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important
            }

            .my-xxl-1 {
                margin-top: .25rem !important;
                margin-bottom: .25rem !important
            }

            .my-xxl-2 {
                margin-top: .5rem !important;
                margin-bottom: .5rem !important
            }

            .my-xxl-3 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important
            }

            .my-xxl-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important
            }

            .my-xxl-5 {
                margin-top: 3rem !important;
                margin-bottom: 3rem !important
            }

            .my-xxl-auto {
                margin-top: auto !important;
                margin-bottom: auto !important
            }

            .mt-xxl-0 {
                margin-top: 0 !important
            }

            .mt-xxl-1 {
                margin-top: .25rem !important
            }

            .mt-xxl-2 {
                margin-top: .5rem !important
            }

            .mt-xxl-3 {
                margin-top: 1rem !important
            }

            .mt-xxl-4 {
                margin-top: 1.5rem !important
            }

            .mt-xxl-5 {
                margin-top: 3rem !important
            }

            .mt-xxl-auto {
                margin-top: auto !important
            }

            .me-xxl-0 {
                margin-right: 0 !important
            }

            .me-xxl-1 {
                margin-right: .25rem !important
            }

            .me-xxl-2 {
                margin-right: .5rem !important
            }

            .me-xxl-3 {
                margin-right: 1rem !important
            }

            .me-xxl-4 {
                margin-right: 1.5rem !important
            }

            .me-xxl-5 {
                margin-right: 3rem !important
            }

            .me-xxl-auto {
                margin-right: auto !important
            }

            .mb-xxl-0 {
                margin-bottom: 0 !important
            }

            .mb-xxl-1 {
                margin-bottom: .25rem !important
            }

            .mb-xxl-2 {
                margin-bottom: .5rem !important
            }

            .mb-xxl-3 {
                margin-bottom: 1rem !important
            }

            .mb-xxl-4 {
                margin-bottom: 1.5rem !important
            }

            .mb-xxl-5 {
                margin-bottom: 3rem !important
            }

            .mb-xxl-auto {
                margin-bottom: auto !important
            }

            .ms-xxl-0 {
                margin-left: 0 !important
            }

            .ms-xxl-1 {
                margin-left: .25rem !important
            }

            .ms-xxl-2 {
                margin-left: .5rem !important
            }

            .ms-xxl-3 {
                margin-left: 1rem !important
            }

            .ms-xxl-4 {
                margin-left: 1.5rem !important
            }

            .ms-xxl-5 {
                margin-left: 3rem !important
            }

            .ms-xxl-auto {
                margin-left: auto !important
            }

            .p-xxl-0 {
                padding: 0 !important
            }

            .p-xxl-1 {
                padding: .25rem !important
            }

            .p-xxl-2 {
                padding: .5rem !important
            }

            .p-xxl-3 {
                padding: 1rem !important
            }

            .p-xxl-4 {
                padding: 1.5rem !important
            }

            .p-xxl-5 {
                padding: 3rem !important
            }

            .px-xxl-0 {
                padding-right: 0 !important;
                padding-left: 0 !important
            }

            .px-xxl-1 {
                padding-right: .25rem !important;
                padding-left: .25rem !important
            }

            .px-xxl-2 {
                padding-right: .5rem !important;
                padding-left: .5rem !important
            }

            .px-xxl-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important
            }

            .px-xxl-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important
            }

            .px-xxl-5 {
                padding-right: 3rem !important;
                padding-left: 3rem !important
            }

            .py-xxl-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important
            }

            .py-xxl-1 {
                padding-top: .25rem !important;
                padding-bottom: .25rem !important
            }

            .py-xxl-2 {
                padding-top: .5rem !important;
                padding-bottom: .5rem !important
            }

            .py-xxl-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important
            }

            .py-xxl-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important
            }

            .py-xxl-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important
            }

            .pt-xxl-0 {
                padding-top: 0 !important
            }

            .pt-xxl-1 {
                padding-top: .25rem !important
            }

            .pt-xxl-2 {
                padding-top: .5rem !important
            }

            .pt-xxl-3 {
                padding-top: 1rem !important
            }

            .pt-xxl-4 {
                padding-top: 1.5rem !important
            }

            .pt-xxl-5 {
                padding-top: 3rem !important
            }

            .pe-xxl-0 {
                padding-right: 0 !important
            }

            .pe-xxl-1 {
                padding-right: .25rem !important
            }

            .pe-xxl-2 {
                padding-right: .5rem !important
            }

            .pe-xxl-3 {
                padding-right: 1rem !important
            }

            .pe-xxl-4 {
                padding-right: 1.5rem !important
            }

            .pe-xxl-5 {
                padding-right: 3rem !important
            }

            .pb-xxl-0 {
                padding-bottom: 0 !important
            }

            .pb-xxl-1 {
                padding-bottom: .25rem !important
            }

            .pb-xxl-2 {
                padding-bottom: .5rem !important
            }

            .pb-xxl-3 {
                padding-bottom: 1rem !important
            }

            .pb-xxl-4 {
                padding-bottom: 1.5rem !important
            }

            .pb-xxl-5 {
                padding-bottom: 3rem !important
            }

            .ps-xxl-0 {
                padding-left: 0 !important
            }

            .ps-xxl-1 {
                padding-left: .25rem !important
            }

            .ps-xxl-2 {
                padding-left: .5rem !important
            }

            .ps-xxl-3 {
                padding-left: 1rem !important
            }

            .ps-xxl-4 {
                padding-left: 1.5rem !important
            }

            .ps-xxl-5 {
                padding-left: 3rem !important
            }

            .gap-xxl-0 {
                gap: 0 !important
            }

            .gap-xxl-1 {
                gap: .25rem !important
            }

            .gap-xxl-2 {
                gap: .5rem !important
            }

            .gap-xxl-3 {
                gap: 1rem !important
            }

            .gap-xxl-4 {
                gap: 1.5rem !important
            }

            .gap-xxl-5 {
                gap: 3rem !important
            }

            .row-gap-xxl-0 {
                row-gap: 0 !important
            }

            .row-gap-xxl-1 {
                row-gap: .25rem !important
            }

            .row-gap-xxl-2 {
                row-gap: .5rem !important
            }

            .row-gap-xxl-3 {
                row-gap: 1rem !important
            }

            .row-gap-xxl-4 {
                row-gap: 1.5rem !important
            }

            .row-gap-xxl-5 {
                row-gap: 3rem !important
            }

            .column-gap-xxl-0 {
                -moz-column-gap: 0 !important;
                column-gap: 0 !important
            }

            .column-gap-xxl-1 {
                -moz-column-gap: 0.25rem !important;
                column-gap: .25rem !important
            }

            .column-gap-xxl-2 {
                -moz-column-gap: 0.5rem !important;
                column-gap: .5rem !important
            }

            .column-gap-xxl-3 {
                -moz-column-gap: 1rem !important;
                column-gap: 1rem !important
            }

            .column-gap-xxl-4 {
                -moz-column-gap: 1.5rem !important;
                column-gap: 1.5rem !important
            }

            .column-gap-xxl-5 {
                -moz-column-gap: 3rem !important;
                column-gap: 3rem !important
            }

            .text-xxl-start {
                text-align: left !important
            }

            .text-xxl-end {
                text-align: right !important
            }

            .text-xxl-center {
                text-align: center !important
            }
        }

        @media (min-width:1200px) {
            .fs-1 {
                font-size: 2.5rem !important
            }

            .fs-2 {
                font-size: 2rem !important
            }

            .fs-3 {
                font-size: 1.75rem !important
            }

            .fs-4 {
                font-size: 1.5rem !important
            }
        }

        @media print {
            .d-print-inline {
                display: inline !important
            }

            .d-print-inline-block {
                display: inline-block !important
            }

            .d-print-block {
                display: block !important
            }

            .d-print-grid {
                display: grid !important
            }

            .d-print-inline-grid {
                display: inline-grid !important
            }

            .d-print-table {
                display: table !important
            }

            .d-print-table-row {
                display: table-row !important
            }

            .d-print-table-cell {
                display: table-cell !important
            }

            .d-print-flex {
                display: flex !important
            }

            .d-print-inline-flex {
                display: inline-flex !important
            }

            .d-print-none {
                display: none !important
            }
        }

        /*# sourceMappingURL=bootstrap.min.css.map */
        :root {
            --bs-body-bg: #ffffff;
            --bs-card-border-color: #ccc;
        }

        .bg-light {
            background-color: #f6f7f9 !important;
        }

        h4,
        h5 {
            color: #114a68;
        }

        th {
            color: #114a68;
        }

        tr:nth-child(even) {
            background-color: #fbfbfb;
        }

        .card-title {
            color: #114a68;
        }

        .dataType {
            color: #959da4 !important;
        }

        .search {
            fill: #0065b6 !important;
        }

        input {
            background-color: #ffffff;
            border: 1px solid #aaaaaa;
            border-radius: 12px;
            padding: 2px 8px;
        }

        input::placeholder {
            color: #aaaaaa;
            font-style: italic;
        }
    </style>

</head>

<body class='bg-light'>
    <div class='container-fluid text-center'>



        <a name='layout1' style='position:sticky; top:0;' />
        <h4>Main Diagram</h4>
        <div class='svgContainer'>
            <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='2071'
                height='1896' viewBox='0 0 2071 1896'>
                <script type='text/ecmascript'>
                    function hghl(el) { for (var i in el) { var elem = document.getElementById(el[i]); if (elem != null) elem.setAttribute('class', 'highlight'); } }
                    function uhghl(el) { for (var i in el) { var elem = document.getElementById(el[i]); if (elem != null) elem.setAttribute('class', 'unhighlight'); } }
                </script>

                <style type='text/css'>
                    text {
                        fill: #6e798a;
                        font-weight: normal;
                        stroke: #2a2b2c;
                        stroke-width: .1px;
                        font-family: Segoe UI, 'Segoe UI', Dialog;
                        font-size: 13.0px;
                    }

                    text.tableHeader {
                        fill: #576b57;
                        font-weight: normal;
                        stroke: #2a2b2c;
                        stroke-width: .1px;
                        font-family: Segoe UI, 'Segoe UI', Dialog;
                        font-size: 13.5px;
                        font-weight: Regular;
                    }

                    a text:hover {
                        font-weight: 500;
                    }

                    text.highlight {
                        font-weight: 500;
                    }

                    text.white {
                        fill: #ffffff;
                    }

                    text.colType {
                        fill: #bac1cb;
                    }

                    text.relName {
                        fill: #9c9a9a;
                        stroke-width: 0;
                    }

                    text.dataType {
                        stroke: 0;
                        font-size: 12px;
                        text-anchor: end;
                    }

                    text.legendTitle {
                        fill: #2b3b64;
                        font-weight: 500;
                    }

                    text.legendSubTitle {
                        fill: #616161;
                        font-size: 12px;
                    }

                    path,
                    circle {
                        stroke: #b2b3b4;
                        stroke-width: 1.5;
                        fill: none;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                    }

                    .filled {
                        fill: #7f7971;
                    }

                    path.virtual {
                        stroke: #71527b;
                    }

                    path.logo {
                        fill: #fbeac0;
                        fill-opacity: 1;
                        stroke-width: 0.3;
                        stroke: #222222;
                    }

                    path.dotted {
                        stroke-dasharray: 3, 3;
                    }

                    path.unhighlight {
                        stroke-width: 12;
                        opacity: 0;
                        pointer-events: all;
                    }

                    path.highlight {
                        stroke-width: 2;
                        stroke: #154b95;
                        opacity: 1;
                        pointer-events: all;
                    }

                    path.line {
                        stroke-width: 10;
                        stroke-linecap: round;
                        stroke-linejoin: round;
                    }

                    rect.entity {
                        fill: #ffffff;
                        stroke-width: 1;
                        shape-rendering: crispEdges;
                        filter: url(#shadow);
                    }

                    line.delim {
                        stroke-width: 1px;
                        shape-rendering: crispEdges;
                    }

                    text.callout {
                        fill: #201a10;
                        font-family: Segoe UI, 'Segoe UI', Dialog;
                        font-size: 14.0px;
                    }

                    rect.callout {
                        fill: url(#calloutGradient);
                        stroke-width: 1px;
                        stroke: #d0cec3;
                    }

                    rect.shape {
                        stroke: #bebdbd;
                        stroke-width: 0.5;
                    }

                    rect.legend {
                        fill: url(#legendGradient);
                        stroke-width: 1px;
                        stroke: #d6dbe4;
                    }

                    text.grp {
                        fill: #b1b1b1;
                    }

                    rect.grp {
                        stroke: #aee1ab;
                        stroke-width: 2;
                        opacity: 0.7;
                    }

                    path.bgPattern {
                        fill: none;
                        stroke-width: 0.6;
                        stroke: #e5e9ee;
                    }

                    path.eval {
                        fill: #efefef;
                        fill-opacity: 1;
                        stroke-width: 0.6;
                        stroke: #e9e9e9;
                    }

                    rect.palpable {
                        fill: #fffbe5;
                    }
                </style>
                <defs>
                    <pattern id="layoutBgA" width="60" height="34.64" patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="60" height="34.64" fill="#f6f7f9" />
                    </pattern>
                    <pattern id='layoutBgEval' width='300' height='300' x='0' y='0' patternUnits="userSpaceOnUse">
                        <g transform='scale(1.5)'>
                            <path class='eval'
                                d='m 62.011835,91.267143 c 3.536475,3.175214 2.262669,8.705999 -1.637711,11.015197 -3.594697,5.8423 -6.34682,-2.892623 -9.715478,-4.653898 -5.609222,-2.838926 2.050802,-6.680123 4.77004,-8.319046 2.334696,-0.724067 4.935143,0.312302 6.583149,1.957747 z m -2.720492,2.538595 c -2.698397,-3.517732 -9.282815,1.269287 -3.69635,3.568637 2.765331,5.605665 7.052809,-0.56184 3.69635,-3.568637 z' />
                            <path class='eval'
                                d='m 72.25864,84.624638 c 4.108046,3.143003 -0.737059,6.895259 -1.994918,8.323564 -3.586718,5.561143 -6.495079,-4.197379 -10.07759,-5.582178 -4.443422,-1.088878 1.349298,-7.249213 2.503526,-2.503449 2.464639,4.517161 2.304019,-3.70697 6.291113,-1.995914 1.280083,0.137865 2.410691,0.864819 3.277869,1.757977 z m -2.646109,2.323242 c -4.797162,-3.078383 -2.810517,6.305507 0.515161,1.990646 0.296432,-0.688582 0.01209,-1.493412 -0.515161,-1.990646 z' />
                            <path class='eval'
                                d='m 78.230641,79.436735 c 4.142121,3.027466 -2.020102,10.435276 -3.450543,5.477315 3.306312,-5.248112 -9.186019,-2.220094 -5.805994,-8.77679 -0.544141,-3.93011 6.797826,-2.102227 3.386015,0.245477 -0.181085,2.915838 4.637371,1.019311 5.870522,3.053982 z' />
                            <path class='eval'
                                d='m 82.744502,72.597397 c -4.901605,1.926521 1.146497,6.285555 2.559694,2.225783 6.21817,3.539297 -6.640186,8.416664 -7.590325,1.997457 -2.24365,-2.914883 4.026676,-10.148618 5.030631,-4.22324 z' />
                            <path class='eval'
                                d='m 90.727458,64.259158 c 1.583987,1.690029 3.321317,3.2696 4.81267,5.026353 -2.535706,6.849794 -6.445583,-5.918773 -8.388458,-0.167017 0.782768,2.03426 5.877405,3.752079 2.670979,5.711199 -3.315119,1.519161 -5.782422,-5.157931 -8.858893,-6.780537 -4.229842,-1.139816 1.510134,-7.074128 2.586227,-2.385939 3.141198,5.495193 1.840537,-5.598295 7.177489,-1.404062 z' />
                            <path class='eval'
                                d='m 99.622027,58.374253 c 1.493293,1.9548 -6.281936,7.024659 -0.885258,4.740447 0.386238,-4.434477 6.131941,-1.133173 2.175851,1.618005 -4.421491,6.12739 -13.666659,-3.151506 -7.058299,-7.136537 1.785129,-1.119329 4.348209,-0.743179 5.767706,0.778085 z m -2.900824,1.89746 c -3.608188,-2.208543 -2.280489,5.00803 -0.12563,0.329531 z' />
                            <path class='eval'
                                d='m 115.18023,50.570441 c -1.61703,5.201678 -4.6204,-0.364502 -7.01598,-1.749619 -4.40977,2.122562 4.89641,4.913939 1.89606,7.018157 -2.48061,3.877635 -4.11404,-4.060614 -7.01192,-2.6391 -1.76318,3.107252 7.28394,6.252304 0.87346,7.876177 -1.74515,-2.956649 -9.055498,-5.610518 -3.950378,-8.66062 1.696478,1.897023 1.770418,-5.43503 5.347308,-3.072411 -0.44014,-5.474701 6.11995,-4.950882 7.7846,-0.815355 0.69076,0.682329 1.39587,1.351469 2.07685,2.042771 z' />
                            <path class='eval'
                                d='m 120.54891,39.417125 c 2.50681,1.334124 4.80466,4.941837 0.75044,5.297362 -0.46414,1.89865 -5.25369,5.602652 -8.01742,1.815475 -3.87345,-2.809139 -0.0676,-7.603869 2.3036,-8.133924 1.6795,-3.853018 3.16703,-1.199465 4.96338,1.021087 z m -2.2464,2.175828 c -4.8049,-2.992167 -3.08987,6.380358 0.42374,2.036159 0.33052,-0.677508 0.12099,-1.525836 -0.42374,-2.036159 z' />
                            <path class='eval'
                                d='m 128.50836,24.06821 c -5.10403,3.035506 3.20535,6.383175 5.05938,9.450276 -0.91853,2.95886 -4.06493,3.650723 -5.34691,0.265618 -2.25715,-2.089033 -4.65672,-6.948595 -7.07024,-2.584686 -4.71758,-3.764394 3.81217,-5.812054 5.12382,-9.226328 0.75738,0.677487 1.38637,1.498638 2.23389,2.095175 z' />
                            <path class='eval'
                                d='m 137.14366,22.299812 c -3.09615,2.259885 0.71537,4.412454 1.99042,6.435866 -3.08975,5.080354 -5.91384,-2.98648 -8.92144,-4.094939 1.44369,-3.219573 3.3497,-1.335928 4.27156,-4.41058 0.97822,-0.894325 1.75044,1.871047 2.65946,2.069653 z' />
                            <path class='eval'
                                d='m 136.85093,14.890174 c 2.31562,5.283511 -7.17975,1.771993 -1.29675,-0.475107 l 0.7108,0.08973 z m 4.867,5.317354 c 2.56912,1.439678 4.26517,4.725219 0.30678,5.233637 -1.56592,-3.098864 -9.51683,-5.749448 -3.64502,-8.633714 1.17746,0.325095 2.15375,2.591149 3.33824,3.400077 z' />
                            <path class='eval'
                                d='m 149.95578,11.976423 c 2.50679,1.334142 4.80455,4.94192 0.75041,5.297394 -0.4641,1.898604 -5.25368,5.602645 -8.0174,1.81545 -3.87347,-2.80918 -0.0676,-7.603844 2.30366,-8.133968 1.67949,-3.8530525 3.16695,-1.1993573 4.96333,1.021124 z m -2.24641,2.175828 c -4.80489,-2.992177 -3.08986,6.380343 0.42374,2.036167 0.33055,-0.677518 0.121,-1.52585 -0.42374,-2.036167 z' />
                            <path class='eval'
                                d='m 153.26135,7.538431 c 2.60497,1.5799548 6.03999,5.944272 1.08117,6.050232 -2.53319,-3.231828 -7.20316,-6.4304525 -8.84748,-9.4582682 1.89121,-2.8664883 3.78452,-2.247699 5.38514,0.8929426 0.78017,0.8503859 1.57195,1.6911437 2.38118,2.5150667 z' />
                        </g>
                    </pattern>
                    <linearGradient id='legendGradient' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#eef5fc' />
                        <stop offset='100%' stop-color='#f7fafe' />
                    </linearGradient>
                    <!-- https://norbat.de/svg-pattern-3d-webmuster/ -->
                    <linearGradient id='calloutGradient' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#efeae1dd' />
                        <stop offset='100%' stop-color='#e8e9eadd' />
                    </linearGradient>
                    <filter id="shadow">
                        <feDropShadow dx="0" dy="0" stdDeviation="3" flood-color="#a0a0a0" flood-opacity="0.4" />
                    </filter>
                    <!--
  <filter id='shadow2' width='120%' height='120%'>
    <feOffset result='offOut' in='SourceGraphic' dx='0' dy='0' />
    <feColorMatrix result='matrixOut' in='offOut'
                   values='0.5 0 0 0 0 0 0.5 0 0 0 0 0 0.5 0 0 0 0 0 0.5 0' />
    <feGaussianBlur result='blurOut' in='matrixOut' stdDeviation='3' />
    <feBlend in='SourceGraphic' in2='blurOut' />
  </filter>
  -->
                    <filter id='fkShadow' height='130%'>
                        <feGaussianBlur in='SourceAlpha' stdDeviation='1.5' /> <!-- stdDeviation is how much to blur -->
                        <feOffset dx='1.2' dy='1.2' result='offsetblur' /> <!-- how much to offset -->
                        <feMerge>
                            <feMergeNode /> <!-- this contains the offset blurred image -->
                            <feMergeNode in='SourceGraphic' />
                            <!-- this contains the element that the filter is applied to -->
                        </feMerge>
                    </filter>
                    <symbol id='calloutArrowDown'>
                        <path d='M 0,0 L 8,12 L 16,0 z' style='fill:#f8f6d1;stroke:none; filter: url(#shadow);' />
                        <path d='M 0,0 L 8,12 L 16,0' style='stroke:#bebdbd; stroke-width:0.5;' />
                    </symbol>
                    <symbol id='calloutArrowUp'>
                        <path d='M 0,16 L 8,4 L 16,16 z' style='fill:#ffffff; stroke:none; filter: url(#shadow);' />
                        <path d='M 0,16 L 8,4 L 16,16' style='stroke:#bebdbd; stroke-width:0.5;' />
                    </symbol>
                    <symbol id='pk' width="13" height="13">
                        <g>
                            <path
                                style='fill:#999999;stroke:#999999;stroke-width:0.2;stroke-linecap:round;stroke-linejoin:round;'
                                d='M 9.3678877,3.5695485 C 9.1030218,3.2729386 9.0796382,2.7628519 9.3396185,2.4517097 9.5449651,2.1956495 9.9040386,2.0980533 10.199638,2.2169415 10.533525,2.3415459 10.775153,2.706942 10.750675,3.0842709 10.737029,3.3980003 10.541153,3.699122 10.258248,3.8066067 9.966649,3.9250429 9.6169668,3.8418805 9.4008073,3.6062324 9.3894892,3.5943518 9.3785264,3.582104 9.3678886,3.5695487 z M 11.226617,6.9916004 C 11.888137,6.3548946 12.293488,5.4172188 12.311087,4.442353 12.378144,2.7379364 11.248678,1.0541269 9.7322318,0.44767357 8.3887112,-0.1280313 6.7865012,0.26822889 5.8918395,1.4007929 5.080823,2.3839145 4.9336815,3.8452096 5.3635544,5.101615 L 4.3670905,5.315913 C 4.0664984,5.3682645 4.0967703,5.6316724 4.2574957,5.8208829 L 4.9124,6.5655244 4.1543436,7.2512357 3.2136002,7.2163506 3.1674775,8.5586827 2.0406832,8.5086512 1.5965306,8.9299953 1.5471661,10.179833 0.75616674,10.195223 0.2112857,10.758575 0.15354288,11.735988 0.07199052,12.765553 c 0.36440953,0.238225 0.79006967,0.195492 1.44938278,-0.02675 L 6.3033562,8.1282037 6.8217102,8.6765688 C 6.9985465,8.8799427 7.3003699,8.7497574 7.358381,8.5016252 L 7.4938877,7.5084164 c 0.8537488,0.3985387 1.8303125,0.4711541 2.6851793,0.1427713 0.393927,-0.1407258 0.746858,-0.3701772 1.04755,-0.6595873 z' />
                            <path
                                d='M 6.8014948,6.3102123 0.15369063,13.024481 0.21560535,12.141962 6.0062342,6.2683782 z'
                                style='fill:#999999;fill-opacity:1;stroke:#999999;stroke-width:0.06912433;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-opacity:1;stroke-dasharray:none;stroke-dashoffset:3.00300009' />
                        </g>
                    </symbol>
                    <symbol id='idx1' width="13" height="13">
                        <g transform='scale(0.99)'>
                            <rect width='4' height='4' x='7' y='1' style='fill:#ffff3f;stroke:#b48333;stroke-width:0.6;'
                                ry='0.83' />
                            <rect width='4' height='4' x='1' y='7' style='fill:#ffff3f;stroke:#b48333;stroke-width:0.6;'
                                ry='0.832' />
                            <rect width='4' height='4' x='7' y='7' style='fill:#ffff3f;stroke:#b48333;stroke-width:0.6;'
                                ry='0.832' />
                        </g>
                    </symbol>
                    <symbol id='idx2' width="13" height="13">
                        <g transform='scale(0.99)'>
                            <rect width='4' height='3' x='6' y='1' style='fill:#7fc8e9;stroke:#2f6f8c;stroke-width:0.6;'
                                ry='0.83' />
                            <rect width='7' height='3' x='3' y='6' style='fill:#7fc8e9;stroke:#2f6f8c;stroke-width:0.6;'
                                ry='0.832' />
                        </g>
                    </symbol>
                    <symbol id='unq' width="13" height="13">
                        <g transform='scale(0.75)'>
                            <path style="fill:#999999;stroke:none;"
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            <text x='4' y='9' style='font-size:8px;fill:#999999;'>1</text>
                        </g>
                    </symbol>
                    <symbol id='idx' width="13" height="13">
                        <g transform='scale(0.75)'>
                            <path style="fill:#999999;stroke:none;"
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </g>
                    </symbol>
                    <symbol id='fk' width="13" height="13">
                        <g transform='scale(0.87)'>
                            <path
                                style='fill:none;stroke:#5a72a8;stroke-width:1;stroke-linecap:butt;stroke-linejoin:round;stroke-miterlimit:4;'
                                d='M 1.1,11 1,5.3 C 1,3.6 1.6,3.3 2.9,3.3 l 7.9,0' />
                            <path
                                style='fill:#5a72a8;stroke:#5a72a8;stroke-width:1;stroke-linecap:butt;stroke-linejoin:round;stroke-miterlimit:4;'
                                d='M 6.3,0.8 11.3,3.4 6.3,5.6 Z' />
                        </g>
                    </symbol>
                    <symbol id='ref' width="13" height="13">
                        <g transform='scale(0.87)'>
                            <path
                                style='fill:none;stroke:#906b25;stroke-width:1;stroke-linecap:butt;stroke-linejoin:round;stroke-miterlimit:4;'
                                d='m 10.9,11.2 0,-5.8 C 10,3.7 10,3 9,3 l -7.9,0' />
                            <path
                                style='fill:#906b25;stroke:#906b25;stroke-width:1;stroke-linecap:butt;stroke-linejoin:round;stroke-miterlimit:4;'
                                d='M 5.7,0.8 0.7,3.4 5.7,5.6 Z' />
                        </g>
                    </symbol>
                    <symbol id='flagBlue' width="16" height="16">
                        <g transform='scale(0.75)'>
                            <path style="fill:#b7d0f6;stroke:none;"
                                d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                        </g>
                    </symbol>
                    <symbol id='flagRed' width="16" height="16">
                        <g transform='scale(0.75)'>
                            <path style="fill:#f4a393;stroke:none;"
                                d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                        </g>
                    </symbol>
                    <symbol id='flagGreen' width="16" height="16">
                        <g transform='scale(0.75)'>
                            <path style="fill:#77ec8b;stroke:none;"
                                d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                        </g>
                    </symbol>
                    <symbol id='nn' width="3" height="3">
                        <path
                            style='stroke:#da897b;stroke-width:0.5;stroke-linecap:butt;stroke-linejoin:round;stroke-miterlimit:4;'
                            d='M 0,0 3,3 M 0,3 3,0 z' />
                    </symbol>
                    <symbol id='virtual' width="16" height="16">
                        <g transform='scale(0.99)'>
                            <circle cx='8' cy='8' r='5' style='stroke:#9e9185;stroke-width:1;fill:transparent' />
                            <path
                                style='stroke:#5394b8;stroke-width:1.5;stroke-linecap:butt;stroke-linejoin:round;stroke-miterlimit:4;'
                                d='M 2.71,5.8 Q-2.12,-2.20 9.15,6.52 Q 17.92,17.67 10.53,13.56' />
                            <path
                                style='stroke:#5394b8;stroke-width:1.5;stroke-linecap:butt;stroke-linejoin:round;stroke-miterlimit:4;'
                                d='M 5.47,13.64 Q -1.82,17.24 6.65,6.78 Q 17.88,-1.36 13.51,5.42' />
                        </g>
                    </symbol>
                    <symbol id='leaf' width="16" height="16">
                        <g transform='scale(0.99)'>
                            <path
                                style='stroke:#7290ab9d;stroke-width:1;stroke-linecap:butt;stroke-linejoin:round;stroke-miterlimit:4;'
                                d='M .7,0 L.7,9.2 L3.85,9.2' />
                            <text x="4" y="13" style='fill:#b0880d;stroke-width:0;font-size:14px;'>{ }</text>
                        </g>
                    </symbol>
                    <symbol id='leafArray' width="16" height="16">
                        <g transform='scale(0.99)'>
                            <path
                                style='stroke:#7290ab9d;stroke-width:1;stroke-linecap:butt;stroke-linejoin:round;stroke-miterlimit:4;'
                                d='M .7,0 L.7,9.2 L3.85,9.2' />
                            <text x="4" y="13" style='fill:#b0880d;stroke-width:0;font-size:14px;'>[ ]</text>
                        </g>
                    </symbol>
                    <symbol id='view' width="13" height="13">
                        <g transform='scale(0.81)'>
                            <path style="fill:#999999;stroke:none;"
                                d="M3 2.5A1.5 1.5 0 0 1 4.5 1h1A1.5 1.5 0 0 1 7 2.5V5h2V2.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5v2.382a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V14.5a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 14.5v-3a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5v3A1.5 1.5 0 0 1 5.5 16h-3A1.5 1.5 0 0 1 1 14.5V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882zM4.5 2a.5.5 0 0 0-.5.5V3h2v-.5a.5.5 0 0 0-.5-.5zM6 4H4v.882a1.5 1.5 0 0 1-.83 1.342l-.894.447A.5.5 0 0 0 2 7.118V13h4v-1.293l-.854-.853A.5.5 0 0 1 5 10.5v-1A1.5 1.5 0 0 1 6.5 8h3A1.5 1.5 0 0 1 11 9.5v1a.5.5 0 0 1-.146.354l-.854.853V13h4V7.118a.5.5 0 0 0-.276-.447l-.895-.447A1.5 1.5 0 0 1 12 4.882V4h-2v1.5a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5zm4-1h2v-.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm4 11h-4v.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zm-8 0H2v.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5z" />
                        </g>
                    </symbol>
                    <symbol id='logo' width="100" height="100" style="filter:url(#shadow);">
                        <path style='stroke:none;fill:#5d5d5d'
                            d='M2.41,6.80 17.39,0.35 26.83,7.21 28.32,24.45 12.62,29.77 1.74,23.96' />
                        <path style='stroke:none;fill:#efefef' d='M 2.21, 6.45  9.36, 3.49  9.42,11.63  2.04,14.42' />
                        <path style='stroke:none;fill:#efefef' d='M10.23, 3.14 17.39, 0.17 17.68, 8.59 10.29,11.28' />
                        <path style='stroke:none;fill:#d2d2d2' d='M17.44, 0.17 21.59, 3.55 22.36,11.43 17.76,8.63' />
                        <path style='stroke:none;fill:#d2d2d2' d='M22.67, 4.33 26.98, 7.06 27.65,14.77 23.20,11.77' />
                        <path style='stroke:none;fill:#efefef' d='M1.89,15.58  9.39,12.65  9.48,21.14  1.57,24.10' />
                        <path style='stroke:none;fill:#17afde' d='M10.38,12.36 17.70, 9.51 18.11,18.37 10.32 20.96' />
                        <path style='stroke:none;fill:#1389ad' d='M17.73, 9.59 22.41,12.47 22.82,21.14 18.05,18.34' />
                        <path style='stroke:none;fill:#d2d2d2' d='M23.26,12.94 27.62,15.70 28.42,24.54 23.69,21.60' />
                        <path style='stroke:none;fill:#828282' d='M1.57,24.19  9.45,21.22 14.30,24.40  6.80,26.80' />
                        <path style='stroke:none;fill:#0c485c' d='M10.47,20.90 18.11,18.32 22.82,21.19 15.20,23.81' />
                        <path style='stroke:none;fill:#828282' d='M23.69,21.63 28.32,24.65 20.87,27.07 15.84,24.30' />
                        <path style='stroke:none;fill:#828282' d='M14.94,24.68 19.80,27.41 12.59,29.97  7.73,27.21' />
                    </symbol>
                    <symbol id="bulb" viewBox="0 0 24 24">
                        <rect x="10" y="16" width="4" height="6" rx="1.5" ry="1.5"
                            style='fill:#c4ae85;stroke:#c3ad44;stroke-width:0.3;stroke-linecap:round;stroke-linejoin:round;filter:url(#shadow);' />
                        <circle cx="12" cy="12" r="5"
                            style='fill:#fff9c1;stroke:#c3ad44;stroke-width:0.3;filter:url(#shadow);' />
                    </symbol>
                </defs>

                <defs>
                    <marker id='ZeroMore' viewBox='0 0 9.50 9.50' refX='4.75' refY='4.75' markerWidth='9.50'
                        markerHeight='9.50' orient='auto-start-reverse'>
                        <circle cx='2.38' cy='4.75' r='2.38' style='stroke-width:1;' />
                        <path d='M 9.50,0.00 L 4.75,4.75 L 9.50,9.50' style='stroke-width:1;' />
                        <path d='M 0.00,4.75 L 9.50,4.75 z' style='stroke-width:1;' />
                    </marker>
                    <marker id='ZeroOne' viewBox='0 0 9.50 9.50' refX='4.75' refY='4.75' markerWidth='9.50'
                        markerHeight='9.50' orient='auto-start-reverse'>
                        <path d='M 0.00,4.75 L 9.50,4.75 z' style='stroke-width:1;' />
                        <circle cx='2.38' cy='4.75' r='2.38' style='stroke-width:1;' />
                        <path d='M 4.75,0.00 L 4.75, 9.50 z' style='stroke-width:1;' />
                    </marker>
                    <marker id='OneMore' viewBox='0 0 9.50 9.50' refX='4.75' refY='4.75' markerWidth='9.50'
                        markerHeight='9.50' orient='auto-start-reverse'>
                        <path d='M 0.00,4.75 L 9.50,4.75 z' style='stroke-width:1;' />
                        <path d='M 4.75,0.00 L 4.75, 9.50 z' style='stroke-width:1;' />
                        <path d='M 9.50,0.00 L 4.75,4.75 L 9.50,9.50' style='stroke-width:1;' />
                        <path d='M 0.00,4.75 L 9.50,4.75 z' style='stroke-width:1;' />
                    </marker>
                    <marker id='One' viewBox='0 0 9.50 9.50' refX='4.75' refY='4.75' markerWidth='9.50'
                        markerHeight='9.50' orient='auto-start-reverse'>
                        <path d='M 0.00,4.75 L 9.50,4.75 z' style='stroke-width:1;' />
                        <path d='M 4.75,0.00 L 4.75, 9.50 z' style='stroke-width:1;' />
                    </marker>
                    <marker id='Range' viewBox='0 0 9.50 9.50' refX='4.75' refY='4.75' markerWidth='9.50'
                        markerHeight='9.50' orient='auto-start-reverse'>
                        <path d='M 0.00,4.75 L 9.50,4.75 z' style='stroke-width:1;' />
                    </marker>
                    <marker id='Arrow' viewBox='0 0 9.50 9.50' refX='4.75' refY='4.75' markerWidth='9.50'
                        markerHeight='9.50' orient='auto-start-reverse'>
                        <path d='M 4.750,2.375 L 9.500,4.750 L 4.750,7.125 z' style='stroke-width:1;' class='filled' />
                    </marker>
                    <linearGradient id='ttl_BED3F4' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#6C97DE' />
                        <stop offset='100%' stop-color='#A0B7DD' />
                    </linearGradient>
                    <linearGradient id='tbg_BED3F4' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#E3E3E5' />
                        <stop offset='100%' stop-color='#F4F5F7' />
                    </linearGradient>
                    <linearGradient id='ttl_BEBEF4' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#6C6CDE' />
                        <stop offset='100%' stop-color='#A0A0DD' />
                    </linearGradient>
                    <linearGradient id='tbg_BEBEF4' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#E3E3E5' />
                        <stop offset='100%' stop-color='#F4F4F7' />
                    </linearGradient>
                    <linearGradient id='ttl_F7F2EC' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#DEAC6C' />
                        <stop offset='100%' stop-color='#DDC2A0' />
                    </linearGradient>
                    <linearGradient id='tbg_F7F2EC' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#E5E4E3' />
                        <stop offset='100%' stop-color='#F7F5F4' />
                    </linearGradient>
                    <linearGradient id='ttl_4D66CC' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#6C82DE' />
                        <stop offset='100%' stop-color='#A0ACDD' />
                    </linearGradient>
                    <linearGradient id='tbg_4D66CC' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#E3E3E5' />
                        <stop offset='100%' stop-color='#F4F4F7' />
                    </linearGradient>
                    <linearGradient id='ttl_FF9966' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#DE926C' />
                        <stop offset='100%' stop-color='#DDB4A0' />
                    </linearGradient>
                    <linearGradient id='tbg_FF9966' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#E5E3E3' />
                        <stop offset='100%' stop-color='#F7F5F4' />
                    </linearGradient>
                    <linearGradient id='ttl_F4DDBE' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#DEAC6C' />
                        <stop offset='100%' stop-color='#DDC2A0' />
                    </linearGradient>
                    <linearGradient id='tbg_F4DDBE' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#E5E4E3' />
                        <stop offset='100%' stop-color='#F7F5F4' />
                    </linearGradient>
                    <linearGradient id='ttl_EEF7EC' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#7FDE6C' />
                        <stop offset='100%' stop-color='#AADDA0' />
                    </linearGradient>
                    <linearGradient id='tbg_EEF7EC' x1='0%' y1='0%' x2='100%' y2='0%'>
                        <stop offset='0%' stop-color='#E3E5E3' />
                        <stop offset='100%' stop-color='#F4F7F4' />
                    </linearGradient>
                </defs>

                <!-- == Shape Colors == -->
                <!-- == Desktop == -->
                <rect x='0' y='0' width='2071' height='1896' rx='9' ry='9'
                    style='fill:url(#layoutBgA); stroke:#ccc; stroke-width:.7px; cursor:move;' />
                <rect x='1' y='1' width='2069' height='1894' rx='9' ry='9' style='fill:url(#layoutBgEval);' />

                <g transform='translate(0,110)'>
                    <!-- == Group 'app_settings' == -->
                    <rect class='grp' style='fill:#FDFDFF;stroke:#AEC1E2' x='41' y='31' width='811' height='821' rx='8'
                        ry='8' />
                    <text x='55' y='50' style='fill:#90A4C5;'>app&#95;settings</text>
                    <!-- == Group 'wallets' == -->
                    <rect class='grp' style='fill:#FDFDFF;stroke:#AEAEE2' x='877' y='126' width='412' height='745'
                        rx='8' ry='8' />
                    <text x='891' y='145' style='fill:#9090C5;'>wallets</text>
                    <!-- == Group 'Doctor' == -->
                    <rect class='grp' style='fill:#FDFFFD;stroke:#B6E2AE' x='1295' y='107' width='621' height='745'
                        rx='8' ry='8' />
                    <text x='1309' y='126' style='fill:#98C590;'>Doctor</text>
                    <!-- == Group 'User' == -->
                    <rect class='grp' style='fill:#FFFEFD;stroke:#E2CBAE' x='136' y='867' width='659' height='840'
                        rx='8' ry='8' />
                    <text x='150' y='886' style='fill:#C5AE90;'>User</text>
                    <!-- == Group 'Appointment' == -->
                    <rect class='grp' style='fill:#FFFDFD;stroke:#E2BFAE' x='1352' y='943' width='678' height='650'
                        rx='8' ry='8' />
                    <text x='1366' y='962' style='fill:#C5A190;'>Appointment</text>
                    <!-- == Group 'Patient' == -->
                    <rect class='grp' style='fill:#FDFDFF;stroke:#AEB8E2' x='820' y='1019' width='469' height='403'
                        rx='8' ry='8' />
                    <text x='834' y='1038' style='fill:#909AC5;'>Patient</text>
                    <!-- == Fk 'transactions_transactions_wallet_id_foreign' == -->
                    <path id='transactions_transactions_wallet_id_foreign'
                        onmouseover="hghl(['transactions_transactions_wallet_id_foreign','medlink.transactions.wallet_id','medlink.wallets.id'])"
                        onmouseout="uhghl(['transactions_transactions_wallet_id_foreign','medlink.transactions.wallet_id','medlink.wallets.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 1026,551L 1083,551'>
                        <title>&#x1F517; Foreign Key transactions_wallet_id_foreign
                            transactions ref wallets ( wallet_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1026,551L 1083,551'>
                        <title>&#x1F517; Foreign Key transactions_wallet_id_foreign
                            transactions ref wallets ( wallet_id -&gt; id )</title>
                    </path>
                    <text x='1035' y='545' transform='rotate(0 1035,545)' class='relName'>wallet&#95;id</text>
                    <!-- == Fk 'transaction_histories_transaction_histories_user_id_foreign' == -->
                    <path id='transaction_histories_transaction_histories_user_id_foreign'
                        onmouseover="hghl(['transaction_histories_transaction_histories_user_id_foreign','medlink.transaction_histories.user_id','medlink.users.id'])"
                        onmouseout="uhghl(['transaction_histories_transaction_histories_user_id_foreign','medlink.transaction_histories.user_id','medlink.users.id'])"
                        transform='translate(9,0)' class='unhighlight'
                        d='M 931,817L 931,902Q 931,912 921,912L 769,912Q 760,912 760,921L 760,931'>
                        <title>&#x1F517; Foreign Key transaction_histories_user_id_foreign
                            transaction_histories ref users ( user_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 931,817L 931,902Q 931,912 921,912L 769,912Q 760,912 760,921L 760,931'>
                        <title>&#x1F517; Foreign Key transaction_histories_user_id_foreign
                            transaction_histories ref users ( user_id -&gt; id )</title>
                    </path>
                    <text x='943' y='817' transform='rotate(90 943,817)' class='relName'>user&#95;id</text>
                    <!-- == Fk 'transfers_transfers_deposit_id_foreign' == -->
                    <path id='transfers_transfers_deposit_id_foreign'
                        onmouseover="hghl(['transfers_transfers_deposit_id_foreign','medlink.transfers.deposit_id','medlink.transactions.id'])"
                        onmouseout="uhghl(['transfers_transfers_deposit_id_foreign','medlink.transfers.deposit_id','medlink.transactions.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 1121,304L 1026,304'>
                        <title>&#x1F517; Foreign Key transfers_deposit_id_foreign
                            transfers ref transactions ( deposit_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1121,304L 1026,304'>
                        <title>&#x1F517; Foreign Key transfers_deposit_id_foreign
                            transfers ref transactions ( deposit_id -&gt; id )</title>
                    </path>
                    <text x='1072' y='298' transform='rotate(0 1072,298)' class='relName'>deposit&#95;id</text>
                    <!-- == Fk 'transfers_transfers_withdraw_id_foreign' == -->
                    <path id='transfers_transfers_withdraw_id_foreign'
                        onmouseover="hghl(['transfers_transfers_withdraw_id_foreign','medlink.transfers.withdraw_id','medlink.transactions.id'])"
                        onmouseout="uhghl(['transfers_transfers_withdraw_id_foreign','medlink.transfers.withdraw_id','medlink.transactions.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 1121,323L 1026,323'>
                        <title>&#x1F517; Foreign Key transfers_withdraw_id_foreign
                            transfers ref transactions ( withdraw_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1121,323L 1026,323'>
                        <title>&#x1F517; Foreign Key transfers_withdraw_id_foreign
                            transfers ref transactions ( withdraw_id -&gt; id )</title>
                    </path>
                    <text x='1062' y='317' transform='rotate(0 1062,317)' class='relName'>withdraw&#95;id</text>
                    <!-- == Fk 'user_languages_user_languages_language_id_foreign' == -->
                    <path id='user_languages_user_languages_language_id_foreign'
                        onmouseover="hghl(['user_languages_user_languages_language_id_foreign','medlink.user_languages.language_id','medlink.languages.id'])"
                        onmouseout="uhghl(['user_languages_user_languages_language_id_foreign','medlink.user_languages.language_id','medlink.languages.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 361,950L 266,950'>
                        <title>&#x1F517; Foreign Key user_languages_language_id_foreign
                            user_languages ref languages ( language_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 361,950L 266,950'>
                        <title>&#x1F517; Foreign Key user_languages_language_id_foreign
                            user_languages ref languages ( language_id -&gt; id )</title>
                    </path>
                    <text x='301' y='944' transform='rotate(0 301,944)' class='relName'>language&#95;id</text>
                    <!-- == Fk 'user_languages_user_languages_user_id_foreign' == -->
                    <path id='user_languages_user_languages_user_id_foreign'
                        onmouseover="hghl(['user_languages_user_languages_user_id_foreign','medlink.user_languages.user_id','medlink.users.id'])"
                        onmouseout="uhghl(['user_languages_user_languages_user_id_foreign','medlink.user_languages.user_id','medlink.users.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 513,950L 608,950'>
                        <title>&#x1F517; Foreign Key user_languages_user_id_foreign
                            user_languages ref users ( user_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 513,950L 608,950'>
                        <title>&#x1F517; Foreign Key user_languages_user_id_foreign
                            user_languages ref users ( user_id -&gt; id )</title>
                    </path>
                    <text x='522' y='944' transform='rotate(0 522,944)' class='relName'>user&#95;id</text>
                    <!-- == Fk 'supports_supports_user_id_foreign' == -->
                    <path id='supports_supports_user_id_foreign'
                        onmouseover="hghl(['supports_supports_user_id_foreign','medlink.supports.user_id','medlink.users.id'])"
                        onmouseout="uhghl(['supports_supports_user_id_foreign','medlink.supports.user_id','medlink.users.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 551,1140L 608,1140'>
                        <title>&#x1F517; Foreign Key supports_user_id_foreign
                            supports ref users ( user_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 551,1140L 608,1140'>
                        <title>&#x1F517; Foreign Key supports_user_id_foreign
                            supports ref users ( user_id -&gt; id )</title>
                    </path>
                    <text x='560' y='1134' transform='rotate(0 560,1134)' class='relName'>user&#95;id</text>
                    <!-- == Fk 'user_settings_user_settings_user_id_foreign' == -->
                    <path id='user_settings_user_settings_user_id_foreign'
                        onmouseover="hghl(['user_settings_user_settings_user_id_foreign','medlink.user_settings.user_id','medlink.users.id'])"
                        onmouseout="uhghl(['user_settings_user_settings_user_id_foreign','medlink.user_settings.user_id','medlink.users.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 285,1330L 608,1330'>
                        <title>&#x1F517; Foreign Key user_settings_user_id_foreign
                            user_settings ref users ( user_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 285,1330L 608,1330'>
                        <title>&#x1F517; Foreign Key user_settings_user_id_foreign
                            user_settings ref users ( user_id -&gt; id )</title>
                    </path>
                    <text x='294' y='1324' transform='rotate(0 294,1324)' class='relName'>user&#95;id</text>
                    <!-- == Fk 'favorites_favorites_doctor_id_foreign' == -->
                    <path id='favorites_favorites_doctor_id_foreign'
                        onmouseover="hghl(['favorites_favorites_doctor_id_foreign','medlink.favorites.doctor_id','medlink.users.id'])"
                        onmouseout="uhghl(['favorites_favorites_doctor_id_foreign','medlink.favorites.doctor_id','medlink.users.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 475,1387L 608,1387'>
                        <title>&#x1F517; Foreign Key favorites_doctor_id_foreign
                            favorites ref users ( doctor_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 475,1387L 608,1387'>
                        <title>&#x1F517; Foreign Key favorites_doctor_id_foreign
                            favorites ref users ( doctor_id -&gt; id )</title>
                    </path>
                    <text x='484' y='1381' transform='rotate(0 484,1381)' class='relName'>doctor&#95;id</text>
                    <!-- == Fk 'favorites_favorites_patient_id_foreign' == -->
                    <path id='favorites_favorites_patient_id_foreign'
                        onmouseover="hghl(['favorites_favorites_patient_id_foreign','medlink.favorites.patient_id','medlink.users.id'])"
                        onmouseout="uhghl(['favorites_favorites_patient_id_foreign','medlink.favorites.patient_id','medlink.users.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 475,1406L 608,1406'>
                        <title>&#x1F517; Foreign Key favorites_patient_id_foreign
                            favorites ref users ( patient_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 475,1406L 608,1406'>
                        <title>&#x1F517; Foreign Key favorites_patient_id_foreign
                            favorites ref users ( patient_id -&gt; id )</title>
                    </path>
                    <text x='484' y='1400' transform='rotate(0 484,1400)' class='relName'>patient&#95;id</text>
                    <!-- == Fk 'user_insurances_user_insurances_patient_profile_id_foreign' == -->
                    <path id='user_insurances_user_insurances_patient_profile_id_foreign'
                        onmouseover="hghl(['user_insurances_user_insurances_patient_profile_id_foreign','medlink.user_insurances.patient_profile_id','medlink.patient_profiles.id'])"
                        onmouseout="uhghl(['user_insurances_user_insurances_patient_profile_id_foreign','medlink.user_insurances.patient_profile_id','medlink.patient_profiles.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 1007,1140L 1102,1140'>
                        <title>&#x1F517; Foreign Key user_insurances_patient_profile_id_foreign
                            user_insurances ref patient_profiles ( patient_profile_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#One)' marker-end='url(#Arrow)'
                        d='M 1007,1140L 1102,1140'>
                        <title>&#x1F517; Foreign Key user_insurances_patient_profile_id_foreign
                            user_insurances ref patient_profiles ( patient_profile_id -&gt; id )</title>
                    </path>
                    <text x='1016' y='1134' transform='rotate(0 1016,1134)'
                        class='relName'>patient&#95;profile&#95;id</text>
                    <!-- == Fk 'patient_profiles_patient_profiles_user_id_foreign' == -->
                    <path id='patient_profiles_patient_profiles_user_id_foreign'
                        onmouseover="hghl(['patient_profiles_patient_profiles_user_id_foreign','medlink.patient_profiles.user_id','medlink.users.id'])"
                        onmouseout="uhghl(['patient_profiles_patient_profiles_user_id_foreign','medlink.patient_profiles.user_id','medlink.users.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 1102,1083L 779,1083'>
                        <title>&#x1F517; Foreign Key patient_profiles_user_id_foreign
                            patient_profiles ref users ( user_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#One)' marker-end='url(#Arrow)'
                        d='M 1102,1083L 779,1083'>
                        <title>&#x1F517; Foreign Key patient_profiles_user_id_foreign
                            patient_profiles ref users ( user_id -&gt; id )</title>
                    </path>
                    <text x='1071' y='1077' transform='rotate(0 1071,1077)' class='relName'>user&#95;id</text>
                    <!-- == Fk 'notifications_notifications_appointment_id_foreign' == -->
                    <path id='notifications_notifications_appointment_id_foreign'
                        onmouseover="hghl(['notifications_notifications_appointment_id_foreign','medlink.notifications.appointment_id','medlink.appointments.id'])"
                        onmouseout="uhghl(['notifications_notifications_appointment_id_foreign','medlink.notifications.appointment_id','medlink.appointments.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 779,1520L 1824,1520'>
                        <title>&#x1F517; Foreign Key notifications_appointment_id_foreign
                            notifications ref appointments ( appointment_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#ZeroMore)' marker-end='url(#Arrow)'
                        class='dotted ' d='M 779,1520L 1824,1520'>
                        <title>&#x1F517; Foreign Key notifications_appointment_id_foreign
                            notifications ref appointments ( appointment_id -&gt; id )</title>
                    </path>
                    <text x='788' y='1514' transform='rotate(0 788,1514)' class='relName'>appointment&#95;id</text>
                    <!-- == Fk 'notifications_notifications_user_id_foreign' == -->
                    <path id='notifications_notifications_user_id_foreign'
                        onmouseover="hghl(['notifications_notifications_user_id_foreign','medlink.notifications.user_id','medlink.users.id'])"
                        onmouseout="uhghl(['notifications_notifications_user_id_foreign','medlink.notifications.user_id','medlink.users.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 646,1482L 646,1444'>
                        <title>&#x1F517; Foreign Key notifications_user_id_foreign
                            notifications ref users ( user_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 646,1482L 646,1444'>
                        <title>&#x1F517; Foreign Key notifications_user_id_foreign
                            notifications ref users ( user_id -&gt; id )</title>
                    </path>
                    <text x='649' y='1479' transform='rotate(270 649,1479)' class='relName'>user&#95;id</text>
                    <!-- == Fk 'reviews_reviews_appointment_id_foreign' == -->
                    <path id='reviews_reviews_appointment_id_foreign'
                        onmouseover="hghl(['reviews_reviews_appointment_id_foreign','medlink.reviews.appointment_id','medlink.appointments.id'])"
                        onmouseout="uhghl(['reviews_reviews_appointment_id_foreign','medlink.reviews.appointment_id','medlink.appointments.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 1729,1197L 1824,1197'>
                        <title>&#x1F517; Foreign Key reviews_appointment_id_foreign
                            reviews ref appointments ( appointment_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1729,1197L 1824,1197'>
                        <title>&#x1F517; Foreign Key reviews_appointment_id_foreign
                            reviews ref appointments ( appointment_id -&gt; id )</title>
                    </path>
                    <text x='1738' y='1191' transform='rotate(0 1738,1191)' class='relName'>appointment&#95;id</text>
                    <!-- == Fk 'reviews_reviews_doctor_profile_id_foreign' == -->
                    <path id='reviews_reviews_doctor_profile_id_foreign'
                        onmouseover="hghl(['reviews_reviews_doctor_profile_id_foreign','medlink.reviews.doctor_profile_id','medlink.doctor_profiles.id'])"
                        onmouseout="uhghl(['reviews_reviews_doctor_profile_id_foreign','medlink.reviews.doctor_profile_id','medlink.doctor_profiles.id'])"
                        transform='translate(9,0)' class='unhighlight'
                        d='M 1558,1007L 1548,1007Q 1539,1007 1539,997L 1539,826Q 1539,817 1529,817L 1520,817'>
                        <title>&#x1F517; Foreign Key reviews_doctor_profile_id_foreign
                            reviews ref doctor_profiles ( doctor_profile_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1558,1007L 1548,1007Q 1539,1007 1539,997L 1539,826Q 1539,817 1529,817L 1520,817'>
                        <title>&#x1F517; Foreign Key reviews_doctor_profile_id_foreign
                            reviews ref doctor_profiles ( doctor_profile_id -&gt; id )</title>
                    </path>
                    <text x='1471' y='1001' transform='rotate(0 1471,1001)'
                        class='relName'>doctor&#95;profile&#95;id</text>
                    <!-- == Fk 'reviews_reviews_patient_profile_id_foreign' == -->
                    <path id='reviews_reviews_patient_profile_id_foreign'
                        onmouseover="hghl(['reviews_reviews_patient_profile_id_foreign','medlink.reviews.patient_profile_id','medlink.patient_profiles.id'])"
                        onmouseout="uhghl(['reviews_reviews_patient_profile_id_foreign','medlink.reviews.patient_profile_id','medlink.patient_profiles.id'])"
                        transform='translate(9,0)' class='unhighlight'
                        d='M 1596,1235L 1596,1263Q 1596,1273 1586,1273L 1273,1273'>
                        <title>&#x1F517; Foreign Key reviews_patient_profile_id_foreign
                            reviews ref patient_profiles ( patient_profile_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1596,1235L 1596,1263Q 1596,1273 1586,1273L 1273,1273'>
                        <title>&#x1F517; Foreign Key reviews_patient_profile_id_foreign
                            reviews ref patient_profiles ( patient_profile_id -&gt; id )</title>
                    </path>
                    <text x='1608' y='1235' transform='rotate(90 1608,1235)'
                        class='relName'>patient&#95;profile&#95;id</text>
                    <!-- == Fk 'bills_bills_appointment_id_foreign' == -->
                    <path id='bills_bills_appointment_id_foreign'
                        onmouseover="hghl(['bills_bills_appointment_id_foreign','medlink.bills.appointment_id','medlink.appointments.id'])"
                        onmouseout="uhghl(['bills_bills_appointment_id_foreign','medlink.bills.appointment_id','medlink.appointments.id'])"
                        transform='translate(9,0)' class='unhighlight'
                        d='M 1501,1216L 1501,1244Q 1501,1254 1510,1254L 1824,1254'>
                        <title>&#x1F517; Foreign Key bills_appointment_id_foreign
                            bills ref appointments ( appointment_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1501,1216L 1501,1244Q 1501,1254 1510,1254L 1824,1254'>
                        <title>&#x1F517; Foreign Key bills_appointment_id_foreign
                            bills ref appointments ( appointment_id -&gt; id )</title>
                    </path>
                    <text x='1513' y='1216' transform='rotate(90 1513,1216)' class='relName'>appointment&#95;id</text>
                    <!-- == Fk 'doctor_profiles_doctor_profiles_medical_category_id_foreign' == -->
                    <path id='doctor_profiles_doctor_profiles_medical_category_id_foreign'
                        onmouseover="hghl(['doctor_profiles_doctor_profiles_medical_category_id_foreign','medlink.doctor_profiles.medical_category_id','medlink.medical_categories.id'])"
                        onmouseout="uhghl(['doctor_profiles_doctor_profiles_medical_category_id_foreign','medlink.doctor_profiles.medical_category_id','medlink.medical_categories.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 1520,608L 1539,608'>
                        <title>&#x1F517; Foreign Key doctor_profiles_medical_category_id_foreign
                            doctor_profiles ref medical_categories ( medical_category_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#ZeroMore)' marker-end='url(#Arrow)'
                        class='dotted ' d='M 1520,608L 1539,608'>
                        <title>&#x1F517; Foreign Key doctor_profiles_medical_category_id_foreign
                            doctor_profiles ref medical_categories ( medical_category_id -&gt; id )</title>
                    </path>
                    <text x='1529' y='602' transform='rotate(0 1529,602)'
                        class='relName'>medical&#95;category&#95;id</text>
                    <!-- == Fk 'doctor_profiles_doctor_profiles_user_id_foreign' == -->
                    <path id='doctor_profiles_doctor_profiles_user_id_foreign'
                        onmouseover="hghl(['doctor_profiles_doctor_profiles_user_id_foreign','medlink.doctor_profiles.user_id','medlink.users.id'])"
                        onmouseout="uhghl(['doctor_profiles_doctor_profiles_user_id_foreign','medlink.doctor_profiles.user_id','medlink.users.id'])"
                        transform='translate(9,0)' class='unhighlight'
                        d='M 1330,836L 1330,959Q 1330,969 1320,969L 779,969'>
                        <title>&#x1F517; Foreign Key doctor_profiles_user_id_foreign
                            doctor_profiles ref users ( user_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#One)' marker-end='url(#Arrow)'
                        d='M 1330,836L 1330,959Q 1330,969 1320,969L 779,969'>
                        <title>&#x1F517; Foreign Key doctor_profiles_user_id_foreign
                            doctor_profiles ref users ( user_id -&gt; id )</title>
                    </path>
                    <text x='1342' y='836' transform='rotate(90 1342,836)' class='relName'>user&#95;id</text>
                    <!-- == Fk 'services_services_doctor_profile_id_foreign' == -->
                    <path id='services_services_doctor_profile_id_foreign'
                        onmouseover="hghl(['services_services_doctor_profile_id_foreign','medlink.services.doctor_profile_id','medlink.doctor_profiles.id'])"
                        onmouseout="uhghl(['services_services_doctor_profile_id_foreign','medlink.services.doctor_profile_id','medlink.doctor_profiles.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 1729,551L 1520,551'>
                        <title>&#x1F517; Foreign Key services_doctor_profile_id_foreign
                            services ref doctor_profiles ( doctor_profile_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1729,551L 1520,551'>
                        <title>&#x1F517; Foreign Key services_doctor_profile_id_foreign
                            services ref doctor_profiles ( doctor_profile_id -&gt; id )</title>
                    </path>
                    <text x='1642' y='545' transform='rotate(0 1642,545)'
                        class='relName'>doctor&#95;profile&#95;id</text>
                    <!-- == Fk 'work_schedules_work_schedules_doctor_profile_id_foreign' == -->
                    <path id='work_schedules_work_schedules_doctor_profile_id_foreign'
                        onmouseover="hghl(['work_schedules_work_schedules_doctor_profile_id_foreign','medlink.work_schedules.doctor_profile_id','medlink.doctor_profiles.id'])"
                        onmouseout="uhghl(['work_schedules_work_schedules_doctor_profile_id_foreign','medlink.work_schedules.doctor_profile_id','medlink.doctor_profiles.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 1349,380L 1349,513'>
                        <title>&#x1F517; Foreign Key work_schedules_doctor_profile_id_foreign
                            work_schedules ref doctor_profiles ( doctor_profile_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1349,380L 1349,513'>
                        <title>&#x1F517; Foreign Key work_schedules_doctor_profile_id_foreign
                            work_schedules ref doctor_profiles ( doctor_profile_id -&gt; id )</title>
                    </path>
                    <text x='1361' y='380' transform='rotate(90 1361,380)'
                        class='relName'>doctor&#95;profile&#95;id</text>
                    <!-- == Fk 'appointments_appointments_doctor_profile_id_foreign' == -->
                    <path id='appointments_appointments_doctor_profile_id_foreign'
                        onmouseover="hghl(['appointments_appointments_doctor_profile_id_foreign','medlink.appointments.doctor_profile_id','medlink.doctor_profiles.id'])"
                        onmouseout="uhghl(['appointments_appointments_doctor_profile_id_foreign','medlink.appointments.doctor_profile_id','medlink.doctor_profiles.id'])"
                        transform='translate(9,0)' class='unhighlight'
                        d='M 1862,1178L 1862,807Q 1862,798 1852,798L 1520,798'>
                        <title>&#x1F517; Foreign Key appointments_doctor_profile_id_foreign
                            appointments ref doctor_profiles ( doctor_profile_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1862,1178L 1862,807Q 1862,798 1852,798L 1520,798'>
                        <title>&#x1F517; Foreign Key appointments_doctor_profile_id_foreign
                            appointments ref doctor_profiles ( doctor_profile_id -&gt; id )</title>
                    </path>
                    <text x='1865' y='1175' transform='rotate(270 1865,1175)'
                        class='relName'>doctor&#95;profile&#95;id</text>
                    <!-- == Fk 'appointments_appointments_patient_profile_id_foreign' == -->
                    <path id='appointments_appointments_patient_profile_id_foreign'
                        onmouseover="hghl(['appointments_appointments_patient_profile_id_foreign','medlink.appointments.patient_profile_id','medlink.patient_profiles.id'])"
                        onmouseout="uhghl(['appointments_appointments_patient_profile_id_foreign','medlink.appointments.patient_profile_id','medlink.patient_profiles.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 1824,1292L 1273,1292'>
                        <title>&#x1F517; Foreign Key appointments_patient_profile_id_foreign
                            appointments ref patient_profiles ( patient_profile_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1824,1292L 1273,1292'>
                        <title>&#x1F517; Foreign Key appointments_patient_profile_id_foreign
                            appointments ref patient_profiles ( patient_profile_id -&gt; id )</title>
                    </path>
                    <text x='1735' y='1286' transform='rotate(0 1735,1286)'
                        class='relName'>patient&#95;profile&#95;id</text>
                    <!-- == Fk 'appointments_appointments_service_id_foreign' == -->
                    <path id='appointments_appointments_service_id_foreign'
                        onmouseover="hghl(['appointments_appointments_service_id_foreign','medlink.appointments.service_id','medlink.services.id'])"
                        onmouseout="uhghl(['appointments_appointments_service_id_foreign','medlink.appointments.service_id','medlink.services.id'])"
                        transform='translate(9,0)' class='unhighlight' d='M 1881,1178L 1881,760'>
                        <title>&#x1F517; Foreign Key appointments_service_id_foreign
                            appointments ref services ( service_id -&gt; id )</title>
                    </path>
                    <path transform='translate(9,0)' marker-start='url(#OneMore)' marker-end='url(#Arrow)'
                        d='M 1881,1178L 1881,760'>
                        <title>&#x1F517; Foreign Key appointments_service_id_foreign
                            appointments ref services ( service_id -&gt; id )</title>
                    </path>
                    <text x='1884' y='1175' transform='rotate(270 1884,1175)' class='relName'>service&#95;id</text>
                    <!-- == Table 'jobs' == -->
                    <rect id='depict_medlink&#46;jobs' class='entity' style='stroke:#F9FAFC' x='57' y='105' width='133'
                        height='190' rx='4' ry='4' />
                    <rect x='57' y='105' width='133' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='57' y='109' width='133' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.jobs'><text id='depict&#45;medlink&#46;jobs' x='107' y='126'
                            class='tableHeader' style='fill:#414348;'>jobs</text>
                        <title>Table medlink.jobs</title>
                    </a>
                    <use x='58' y='148' xlink:href='#nn' />
                    <use x='59' y='147' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_jobs ( id ) </title>
                    </use><a xlink:href='#medlink.jobs.id'><text id='medlink&#46;jobs&#46;id' x='79' y='160'
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='187' y='156' text-anchor='end' class='colType'>&#35;</text>
                    <use x='58' y='167' xlink:href='#nn' />
                    <use x='59' y='166' xlink:href='#idx'>
                        <title>&#x1F50D; jobs_queue_index ( queue ) </title>
                    </use><a xlink:href='#medlink.jobs.queue'><text id='medlink&#46;jobs&#46;queue' x='79'
                            y='179'>queue</text>
                        <title>&#10697; queue
                            * varchar(255)</title>
                    </a>
                    <text x='187' y='175' text-anchor='end' class='colType'>t</text>
                    <use x='58' y='186' xlink:href='#nn' /><a xlink:href='#medlink.jobs.payload'><text
                            id='medlink&#46;jobs&#46;payload' x='79' y='198'>payload</text>
                        <title>&#10697; payload
                            * longtext</title>
                    </a>
                    <text x='187' y='194' text-anchor='end' class='colType'>t</text>
                    <use x='58' y='205' xlink:href='#nn' /><a xlink:href='#medlink.jobs.attempts'><text
                            id='medlink&#46;jobs&#46;attempts' x='79' y='217'>attempts</text>
                        <title>&#10697; attempts
                            * tinyint</title>
                    </a>
                    <text x='187' y='213' text-anchor='end' class='colType'>&#35;</text> <a
                        xlink:href='#medlink.jobs.reserved_at'><text id='medlink&#46;jobs&#46;reserved&#95;at' x='79'
                            y='236'>reserved&#95;at</text>
                        <title>&#10697; reserved_at
                            int</title>
                    </a>
                    <text x='187' y='232' text-anchor='end' class='colType'>&#35;</text>
                    <use x='58' y='243' xlink:href='#nn' /><a xlink:href='#medlink.jobs.available_at'><text
                            id='medlink&#46;jobs&#46;available&#95;at' x='79' y='255'>available&#95;at</text>
                        <title>&#10697; available_at
                            * int</title>
                    </a>
                    <text x='187' y='251' text-anchor='end' class='colType'>&#35;</text>
                    <use x='58' y='262' xlink:href='#nn' /><a xlink:href='#medlink.jobs.created_at'><text
                            id='medlink&#46;jobs&#46;created&#95;at' x='79' y='274'>created&#95;at</text>
                        <title>&#10697; created_at
                            * int</title>
                    </a>
                    <text x='187' y='270' text-anchor='end' class='colType'>&#35;</text>
                    <!-- == Table 'job_batches' == -->
                    <rect id='depict_medlink&#46;job&#95;batches' class='entity' style='stroke:#F9FAFC' x='228' y='86'
                        width='133' height='247' rx='4' ry='4' />
                    <rect x='228' y='86' width='133' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='228' y='90' width='133' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.job_batches'><text id='depict&#45;medlink&#46;job&#95;batches' x='255'
                            y='107' class='tableHeader' style='fill:#414348;'>job&#95;batches</text>
                        <title>Table medlink.job_batches</title>
                    </a>
                    <use x='229' y='129' xlink:href='#nn' />
                    <use x='230' y='128' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_job_batches ( id ) </title>
                    </use><a xlink:href='#medlink.job_batches.id'><text id='medlink&#46;job&#95;batches&#46;id' x='250'
                            y='141' class='colPk'>id</text>
                        <title>&#10697; id
                            * varchar(255)</title>
                    </a>
                    <text x='358' y='137' text-anchor='end' class='colType'>t</text>
                    <use x='229' y='148' xlink:href='#nn' /><a xlink:href='#medlink.job_batches.name'><text
                            id='medlink&#46;job&#95;batches&#46;name' x='250' y='160'>name</text>
                        <title>&#10697; name
                            * varchar(255)</title>
                    </a>
                    <text x='358' y='156' text-anchor='end' class='colType'>t</text>
                    <use x='229' y='167' xlink:href='#nn' /><a xlink:href='#medlink.job_batches.total_jobs'><text
                            id='medlink&#46;job&#95;batches&#46;total&#95;jobs' x='250' y='179'>total&#95;jobs</text>
                        <title>&#10697; total_jobs
                            * int</title>
                    </a>
                    <text x='358' y='175' text-anchor='end' class='colType'>&#35;</text>
                    <use x='229' y='186' xlink:href='#nn' /><a xlink:href='#medlink.job_batches.pending_jobs'><text
                            id='medlink&#46;job&#95;batches&#46;pending&#95;jobs' x='250'
                            y='198'>pending&#95;jobs</text>
                        <title>&#10697; pending_jobs
                            * int</title>
                    </a>
                    <text x='358' y='194' text-anchor='end' class='colType'>&#35;</text>
                    <use x='229' y='205' xlink:href='#nn' /><a xlink:href='#medlink.job_batches.failed_jobs'><text
                            id='medlink&#46;job&#95;batches&#46;failed&#95;jobs' x='250' y='217'>failed&#95;jobs</text>
                        <title>&#10697; failed_jobs
                            * int</title>
                    </a>
                    <text x='358' y='213' text-anchor='end' class='colType'>&#35;</text>
                    <use x='229' y='224' xlink:href='#nn' /><a xlink:href='#medlink.job_batches.failed_job_ids'><text
                            id='medlink&#46;job&#95;batches&#46;failed&#95;job&#95;ids' x='250'
                            y='236'>failed&#95;job&#95;ids</text>
                        <title>&#10697; failed_job_ids
                            * longtext</title>
                    </a>
                    <text x='358' y='232' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.job_batches.options'><text id='medlink&#46;job&#95;batches&#46;options'
                            x='250' y='255'>options</text>
                        <title>&#10697; options
                            mediumtext</title>
                    </a>
                    <text x='358' y='251' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.job_batches.cancelled_at'><text
                            id='medlink&#46;job&#95;batches&#46;cancelled&#95;at' x='250'
                            y='274'>cancelled&#95;at</text>
                        <title>&#10697; cancelled_at
                            int</title>
                    </a>
                    <text x='358' y='270' text-anchor='end' class='colType'>&#35;</text>
                    <use x='229' y='281' xlink:href='#nn' /><a xlink:href='#medlink.job_batches.created_at'><text
                            id='medlink&#46;job&#95;batches&#46;created&#95;at' x='250' y='293'>created&#95;at</text>
                        <title>&#10697; created_at
                            * int</title>
                    </a>
                    <text x='358' y='289' text-anchor='end' class='colType'>&#35;</text> <a
                        xlink:href='#medlink.job_batches.finished_at'><text
                            id='medlink&#46;job&#95;batches&#46;finished&#95;at' x='250' y='312'>finished&#95;at</text>
                        <title>&#10697; finished_at
                            int</title>
                    </a>
                    <text x='358' y='308' text-anchor='end' class='colType'>&#35;</text>
                    <!-- == Table 'failed_jobs' == -->
                    <rect id='depict_medlink&#46;failed&#95;jobs' class='entity' style='stroke:#F9FAFC' x='380' y='105'
                        width='114' height='190' rx='4' ry='4' />
                    <rect x='380' y='105' width='114' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='380' y='109' width='114' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.failed_jobs'><text id='depict&#45;medlink&#46;failed&#95;jobs' x='402'
                            y='126' class='tableHeader' style='fill:#414348;'>failed&#95;jobs</text>
                        <title>Table medlink.failed_jobs</title>
                    </a>
                    <use x='381' y='148' xlink:href='#nn' />
                    <use x='382' y='147' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_failed_jobs ( id ) </title>
                    </use><a xlink:href='#medlink.failed_jobs.id'><text id='medlink&#46;failed&#95;jobs&#46;id' x='402'
                            y='160' class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='491' y='156' text-anchor='end' class='colType'>&#35;</text>
                    <use x='381' y='167' xlink:href='#nn' />
                    <use x='382' y='166' xlink:href='#unq'>
                        <title>&#x1F50D; Unq failed_jobs_uuid_unique ( uuid ) </title>
                    </use><a xlink:href='#medlink.failed_jobs.uuid'><text id='medlink&#46;failed&#95;jobs&#46;uuid'
                            x='402' y='179'>uuid</text>
                        <title>&#10697; uuid
                            * varchar(255)</title>
                    </a>
                    <text x='491' y='175' text-anchor='end' class='colType'>t</text>
                    <use x='381' y='186' xlink:href='#nn' /><a xlink:href='#medlink.failed_jobs.connection'><text
                            id='medlink&#46;failed&#95;jobs&#46;connection' x='402' y='198'>connection</text>
                        <title>&#10697; connection
                            * text</title>
                    </a>
                    <text x='491' y='194' text-anchor='end' class='colType'>t</text>
                    <use x='381' y='205' xlink:href='#nn' /><a xlink:href='#medlink.failed_jobs.queue'><text
                            id='medlink&#46;failed&#95;jobs&#46;queue' x='402' y='217'>queue</text>
                        <title>&#10697; queue
                            * text</title>
                    </a>
                    <text x='491' y='213' text-anchor='end' class='colType'>t</text>
                    <use x='381' y='224' xlink:href='#nn' /><a xlink:href='#medlink.failed_jobs.payload'><text
                            id='medlink&#46;failed&#95;jobs&#46;payload' x='402' y='236'>payload</text>
                        <title>&#10697; payload
                            * longtext</title>
                    </a>
                    <text x='491' y='232' text-anchor='end' class='colType'>t</text>
                    <use x='381' y='243' xlink:href='#nn' /><a xlink:href='#medlink.failed_jobs.exception'><text
                            id='medlink&#46;failed&#95;jobs&#46;exception' x='402' y='255'>exception</text>
                        <title>&#10697; exception
                            * longtext</title>
                    </a>
                    <text x='491' y='251' text-anchor='end' class='colType'>t</text>
                    <use x='381' y='262' xlink:href='#nn' /><a xlink:href='#medlink.failed_jobs.failed_at'><text
                            id='medlink&#46;failed&#95;jobs&#46;failed&#95;at' x='402' y='274'>failed&#95;at</text>
                        <title>&#10697; failed_at
                            * timestamp default CURRENT_TIMESTAMP</title>
                    </a>

                    <!-- == Table 'migrations' == -->
                    <rect id='depict_medlink&#46;migrations' class='entity' style='stroke:#F9FAFC' x='76' y='390'
                        width='114' height='114' rx='4' ry='4' />
                    <rect x='76' y='390' width='114' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='76' y='394' width='114' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.migrations'><text id='depict&#45;medlink&#46;migrations' x='98' y='411'
                            class='tableHeader' style='fill:#414348;'>migrations</text>
                        <title>Table medlink.migrations</title>
                    </a>
                    <use x='77' y='433' xlink:href='#nn' />
                    <use x='78' y='432' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_migrations ( id ) </title>
                    </use><a xlink:href='#medlink.migrations.id'><text id='medlink&#46;migrations&#46;id' x='98' y='445'
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * int</title>
                    </a>
                    <text x='187' y='441' text-anchor='end' class='colType'>&#35;</text>
                    <use x='77' y='452' xlink:href='#nn' /><a xlink:href='#medlink.migrations.migration'><text
                            id='medlink&#46;migrations&#46;migration' x='98' y='464'>migration</text>
                        <title>&#10697; migration
                            * varchar(255)</title>
                    </a>
                    <text x='187' y='460' text-anchor='end' class='colType'>t</text>
                    <use x='77' y='471' xlink:href='#nn' /><a xlink:href='#medlink.migrations.batch'><text
                            id='medlink&#46;migrations&#46;batch' x='98' y='483'>batch</text>
                        <title>&#10697; batch
                            * int</title>
                    </a>
                    <text x='187' y='479' text-anchor='end' class='colType'>&#35;</text>
                    <!-- == Table 'sessions' == -->
                    <rect id='depict_medlink&#46;sessions' class='entity' style='stroke:#F9FAFC' x='209' y='352'
                        width='133' height='171' rx='4' ry='4' />
                    <rect x='209' y='352' width='133' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='209' y='356' width='133' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.sessions'><text id='depict&#45;medlink&#46;sessions' x='248' y='373'
                            class='tableHeader' style='fill:#414348;'>sessions</text>
                        <title>Table medlink.sessions</title>
                    </a>
                    <use x='210' y='395' xlink:href='#nn' />
                    <use x='211' y='394' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_sessions ( id ) </title>
                    </use><a xlink:href='#medlink.sessions.id'><text id='medlink&#46;sessions&#46;id' x='231' y='407'
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * varchar(255)</title>
                    </a>
                    <text x='339' y='403' text-anchor='end' class='colType'>t</text>
                    <use x='211' y='413' xlink:href='#idx'>
                        <title>&#x1F50D; sessions_user_id_index ( user_id ) </title>
                    </use><a xlink:href='#medlink.sessions.user_id'><text id='medlink&#46;sessions&#46;user&#95;id'
                            x='231' y='426'>user&#95;id</text>
                        <title>&#10697; user_id
                            bigint</title>
                    </a>
                    <text x='339' y='422' text-anchor='end' class='colType'>&#35;</text> <a
                        xlink:href='#medlink.sessions.ip_address'><text id='medlink&#46;sessions&#46;ip&#95;address'
                            x='231' y='445'>ip&#95;address</text>
                        <title>&#10697; ip_address
                            varchar(45)</title>
                    </a>
                    <text x='339' y='441' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.sessions.user_agent'><text id='medlink&#46;sessions&#46;user&#95;agent'
                            x='231' y='464'>user&#95;agent</text>
                        <title>&#10697; user_agent
                            text</title>
                    </a>
                    <text x='339' y='460' text-anchor='end' class='colType'>t</text>
                    <use x='210' y='471' xlink:href='#nn' /><a xlink:href='#medlink.sessions.payload'><text
                            id='medlink&#46;sessions&#46;payload' x='231' y='483'>payload</text>
                        <title>&#10697; payload
                            * longtext</title>
                    </a>
                    <text x='339' y='479' text-anchor='end' class='colType'>t</text>
                    <use x='210' y='490' xlink:href='#nn' />
                    <use x='211' y='489' xlink:href='#idx'>
                        <title>&#x1F50D; sessions_last_activity_index ( last_activity ) </title>
                    </use><a xlink:href='#medlink.sessions.last_activity'><text
                            id='medlink&#46;sessions&#46;last&#95;activity' x='231' y='502'>last&#95;activity</text>
                        <title>&#10697; last_activity
                            * int</title>
                    </a>
                    <text x='339' y='498' text-anchor='end' class='colType'>&#35;</text>
                    <!-- == Table 'cache' == -->
                    <rect id='depict_medlink&#46;cache' class='entity' style='stroke:#F9FAFC' x='361' y='390'
                        width='114' height='114' rx='4' ry='4' />
                    <rect x='361' y='390' width='114' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='361' y='394' width='114' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.cache'><text id='depict&#45;medlink&#46;cache' x='397' y='411'
                            class='tableHeader' style='fill:#414348;'>cache</text>
                        <title>Table medlink.cache</title>
                    </a>
                    <use x='362' y='433' xlink:href='#nn' />
                    <use x='363' y='432' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_cache ( key ) </title>
                    </use><a xlink:href='#medlink.cache.key'><text id='medlink&#46;cache&#46;key' x='383' y='445'
                            class='colPk'>key</text>
                        <title>&#10697; key
                            * varchar(255)</title>
                    </a>
                    <text x='472' y='441' text-anchor='end' class='colType'>t</text>
                    <use x='362' y='452' xlink:href='#nn' /><a xlink:href='#medlink.cache.value'><text
                            id='medlink&#46;cache&#46;value' x='383' y='464'>value</text>
                        <title>&#10697; value
                            * mediumtext</title>
                    </a>
                    <text x='472' y='460' text-anchor='end' class='colType'>t</text>
                    <use x='362' y='471' xlink:href='#nn' /><a xlink:href='#medlink.cache.expiration'><text
                            id='medlink&#46;cache&#46;expiration' x='383' y='483'>expiration</text>
                        <title>&#10697; expiration
                            * int</title>
                    </a>
                    <text x='472' y='479' text-anchor='end' class='colType'>&#35;</text>
                    <!-- == Table 'pulse_aggregates' == -->
                    <rect id='depict_medlink&#46;pulse&#95;aggregates' class='entity' style='stroke:#F9FAFC' x='532'
                        y='124' width='133' height='228' rx='4' ry='4' />
                    <rect x='532' y='124' width='133' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='532' y='128' width='133' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.pulse_aggregates'><text id='depict&#45;medlink&#46;pulse&#95;aggregates'
                            x='543' y='145' class='tableHeader' style='fill:#414348;'>pulse&#95;aggregates</text>
                        <title>Table medlink.pulse_aggregates</title>
                    </a>
                    <use x='533' y='167' xlink:href='#nn' />
                    <use x='534' y='166' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_pulse_aggregates ( id ) </title>
                    </use><a xlink:href='#medlink.pulse_aggregates.id'><text
                            id='medlink&#46;pulse&#95;aggregates&#46;id' x='554' y='179' class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='662' y='175' text-anchor='end' class='colType'>&#35;</text>
                    <use x='533' y='186' xlink:href='#nn' />
                    <use x='534' y='185' xlink:href='#unq'>
                        <title>&#x1F50D; Unq pulse_aggregates_bucket_period_type_aggregate_key_hash_unique ( bucket,
                            period, type, aggregate, key_hash ) &#x1F50D; pulse_aggregates_period_bucket_index ( period,
                            bucket ) &#x1F50D; pulse_aggregates_period_type_aggregate_bucket_index ( period, type,
                            aggregate, bucket ) </title>
                    </use><a xlink:href='#medlink.pulse_aggregates.bucket'><text
                            id='medlink&#46;pulse&#95;aggregates&#46;bucket' x='554' y='198'>bucket</text>
                        <title>&#10697; bucket
                            * int</title>
                    </a>
                    <text x='662' y='194' text-anchor='end' class='colType'>&#35;</text>
                    <use x='533' y='205' xlink:href='#nn' />
                    <use x='534' y='204' xlink:href='#unq'>
                        <title>&#x1F50D; Unq pulse_aggregates_bucket_period_type_aggregate_key_hash_unique ( bucket,
                            period, type, aggregate, key_hash ) &#x1F50D; pulse_aggregates_period_bucket_index ( period,
                            bucket ) &#x1F50D; pulse_aggregates_period_type_aggregate_bucket_index ( period, type,
                            aggregate, bucket ) </title>
                    </use><a xlink:href='#medlink.pulse_aggregates.period'><text
                            id='medlink&#46;pulse&#95;aggregates&#46;period' x='554' y='217'>period</text>
                        <title>&#10697; period
                            * mediumint</title>
                    </a>
                    <text x='662' y='213' text-anchor='end' class='colType'>&#35;</text>
                    <use x='533' y='224' xlink:href='#nn' />
                    <use x='534' y='223' xlink:href='#unq'>
                        <title>&#x1F50D; Unq pulse_aggregates_bucket_period_type_aggregate_key_hash_unique ( bucket,
                            period, type, aggregate, key_hash ) &#x1F50D; pulse_aggregates_type_index ( type ) &#x1F50D;
                            pulse_aggregates_period_type_aggregate_bucket_index ( period, type, aggregate, bucket )
                        </title>
                    </use><a xlink:href='#medlink.pulse_aggregates.type'><text
                            id='medlink&#46;pulse&#95;aggregates&#46;type' x='554' y='236'>type</text>
                        <title>&#10697; type
                            * varchar(255)</title>
                    </a>
                    <text x='662' y='232' text-anchor='end' class='colType'>t</text>
                    <use x='533' y='243' xlink:href='#nn' /><a xlink:href='#medlink.pulse_aggregates.key'><text
                            id='medlink&#46;pulse&#95;aggregates&#46;key' x='554' y='255'>key</text>
                        <title>&#10697; key
                            * mediumtext</title>
                    </a>
                    <text x='662' y='251' text-anchor='end' class='colType'>t</text>
                    <use x='534' y='261' xlink:href='#unq'>
                        <title>&#x1F50D; Unq pulse_aggregates_bucket_period_type_aggregate_key_hash_unique ( bucket,
                            period, type, aggregate, key_hash ) </title>
                    </use><a xlink:href='#medlink.pulse_aggregates.key_hash'><text
                            id='medlink&#46;pulse&#95;aggregates&#46;key&#95;hash' x='554' y='274'>key&#95;hash</text>
                        <title>&#10697; key_hash
                            binary(16)</title>
                    </a>
                    <text x='662' y='270' text-anchor='end' class='colType'>&#126;</text>
                    <use x='533' y='281' xlink:href='#nn' />
                    <use x='534' y='280' xlink:href='#unq'>
                        <title>&#x1F50D; Unq pulse_aggregates_bucket_period_type_aggregate_key_hash_unique ( bucket,
                            period, type, aggregate, key_hash ) &#x1F50D;
                            pulse_aggregates_period_type_aggregate_bucket_index ( period, type, aggregate, bucket )
                        </title>
                    </use><a xlink:href='#medlink.pulse_aggregates.aggregate'><text
                            id='medlink&#46;pulse&#95;aggregates&#46;aggregate' x='554' y='293'>aggregate</text>
                        <title>&#10697; aggregate
                            * varchar(255)</title>
                    </a>
                    <text x='662' y='289' text-anchor='end' class='colType'>t</text>
                    <use x='533' y='300' xlink:href='#nn' /><a xlink:href='#medlink.pulse_aggregates.value'><text
                            id='medlink&#46;pulse&#95;aggregates&#46;value' x='554' y='312'>value</text>
                        <title>&#10697; value
                            * decimal(20,2)</title>
                    </a>
                    <text x='662' y='308' text-anchor='end' class='colType'>&#35;</text> <a
                        xlink:href='#medlink.pulse_aggregates.count'><text
                            id='medlink&#46;pulse&#95;aggregates&#46;count' x='554' y='331'>count</text>
                        <title>&#10697; count
                            int</title>
                    </a>
                    <text x='662' y='327' text-anchor='end' class='colType'>&#35;</text>
                    <!-- == Table 'cache_locks' == -->
                    <rect id='depict_medlink&#46;cache&#95;locks' class='entity' style='stroke:#F9FAFC' x='494' y='390'
                        width='114' height='114' rx='4' ry='4' />
                    <rect x='494' y='390' width='114' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='494' y='394' width='114' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.cache_locks'><text id='depict&#45;medlink&#46;cache&#95;locks' x='513'
                            y='411' class='tableHeader' style='fill:#414348;'>cache&#95;locks</text>
                        <title>Table medlink.cache_locks</title>
                    </a>
                    <use x='495' y='433' xlink:href='#nn' />
                    <use x='496' y='432' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_cache_locks ( key ) </title>
                    </use><a xlink:href='#medlink.cache_locks.key'><text id='medlink&#46;cache&#95;locks&#46;key'
                            x='516' y='445' class='colPk'>key</text>
                        <title>&#10697; key
                            * varchar(255)</title>
                    </a>
                    <text x='605' y='441' text-anchor='end' class='colType'>t</text>
                    <use x='495' y='452' xlink:href='#nn' /><a xlink:href='#medlink.cache_locks.owner'><text
                            id='medlink&#46;cache&#95;locks&#46;owner' x='516' y='464'>owner</text>
                        <title>&#10697; owner
                            * varchar(255)</title>
                    </a>
                    <text x='605' y='460' text-anchor='end' class='colType'>t</text>
                    <use x='495' y='471' xlink:href='#nn' /><a xlink:href='#medlink.cache_locks.expiration'><text
                            id='medlink&#46;cache&#95;locks&#46;expiration' x='516' y='483'>expiration</text>
                        <title>&#10697; expiration
                            * int</title>
                    </a>
                    <text x='605' y='479' text-anchor='end' class='colType'>&#35;</text>
                    <!-- == Table 'pulse_entries' == -->
                    <rect id='depict_medlink&#46;pulse&#95;entries' class='entity' style='stroke:#F9FAFC' x='722'
                        y='124' width='114' height='171' rx='4' ry='4' />
                    <rect x='722' y='124' width='114' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='722' y='128' width='114' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.pulse_entries'><text id='depict&#45;medlink&#46;pulse&#95;entries' x='737'
                            y='145' class='tableHeader' style='fill:#414348;'>pulse&#95;entries</text>
                        <title>Table medlink.pulse_entries</title>
                    </a>
                    <use x='723' y='167' xlink:href='#nn' />
                    <use x='724' y='166' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_pulse_entries ( id ) </title>
                    </use><a xlink:href='#medlink.pulse_entries.id'><text id='medlink&#46;pulse&#95;entries&#46;id'
                            x='744' y='179' class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='833' y='175' text-anchor='end' class='colType'>&#35;</text>
                    <use x='723' y='186' xlink:href='#nn' />
                    <use x='724' y='185' xlink:href='#idx'>
                        <title>&#x1F50D; pulse_entries_timestamp_index ( timestamp ) &#x1F50D;
                            pulse_entries_timestamp_type_key_hash_value_index ( timestamp, type, key_hash, value )
                        </title>
                    </use><a xlink:href='#medlink.pulse_entries.timestamp'><text
                            id='medlink&#46;pulse&#95;entries&#46;timestamp' x='744' y='198'>timestamp</text>
                        <title>&#10697; timestamp
                            * int</title>
                    </a>
                    <text x='833' y='194' text-anchor='end' class='colType'>&#35;</text>
                    <use x='723' y='205' xlink:href='#nn' />
                    <use x='724' y='204' xlink:href='#idx'>
                        <title>&#x1F50D; pulse_entries_type_index ( type ) &#x1F50D;
                            pulse_entries_timestamp_type_key_hash_value_index ( timestamp, type, key_hash, value )
                        </title>
                    </use><a xlink:href='#medlink.pulse_entries.type'><text id='medlink&#46;pulse&#95;entries&#46;type'
                            x='744' y='217'>type</text>
                        <title>&#10697; type
                            * varchar(255)</title>
                    </a>
                    <text x='833' y='213' text-anchor='end' class='colType'>t</text>
                    <use x='723' y='224' xlink:href='#nn' /><a xlink:href='#medlink.pulse_entries.key'><text
                            id='medlink&#46;pulse&#95;entries&#46;key' x='744' y='236'>key</text>
                        <title>&#10697; key
                            * mediumtext</title>
                    </a>
                    <text x='833' y='232' text-anchor='end' class='colType'>t</text>
                    <use x='724' y='242' xlink:href='#idx'>
                        <title>&#x1F50D; pulse_entries_key_hash_index ( key_hash ) &#x1F50D;
                            pulse_entries_timestamp_type_key_hash_value_index ( timestamp, type, key_hash, value )
                        </title>
                    </use><a xlink:href='#medlink.pulse_entries.key_hash'><text
                            id='medlink&#46;pulse&#95;entries&#46;key&#95;hash' x='744' y='255'>key&#95;hash</text>
                        <title>&#10697; key_hash
                            binary(16)</title>
                    </a>
                    <text x='833' y='251' text-anchor='end' class='colType'>&#126;</text>
                    <use x='724' y='261' xlink:href='#idx'>
                        <title>&#x1F50D; pulse_entries_timestamp_type_key_hash_value_index ( timestamp, type, key_hash,
                            value ) </title>
                    </use><a xlink:href='#medlink.pulse_entries.value'><text
                            id='medlink&#46;pulse&#95;entries&#46;value' x='744' y='274'>value</text>
                        <title>&#10697; value
                            bigint</title>
                    </a>
                    <text x='833' y='270' text-anchor='end' class='colType'>&#35;</text>
                    <!-- == Table 'pulse_values' == -->
                    <rect id='depict_medlink&#46;pulse&#95;values' class='entity' style='stroke:#F9FAFC' x='684' y='390'
                        width='114' height='171' rx='4' ry='4' />
                    <rect x='684' y='390' width='114' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='684' y='394' width='114' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.pulse_values'><text id='depict&#45;medlink&#46;pulse&#95;values' x='700'
                            y='411' class='tableHeader' style='fill:#414348;'>pulse&#95;values</text>
                        <title>Table medlink.pulse_values</title>
                    </a>
                    <use x='685' y='433' xlink:href='#nn' />
                    <use x='686' y='432' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_pulse_values ( id ) </title>
                    </use><a xlink:href='#medlink.pulse_values.id'><text id='medlink&#46;pulse&#95;values&#46;id'
                            x='706' y='445' class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='795' y='441' text-anchor='end' class='colType'>&#35;</text>
                    <use x='685' y='452' xlink:href='#nn' />
                    <use x='686' y='451' xlink:href='#idx'>
                        <title>&#x1F50D; pulse_values_timestamp_index ( timestamp ) </title>
                    </use><a xlink:href='#medlink.pulse_values.timestamp'><text
                            id='medlink&#46;pulse&#95;values&#46;timestamp' x='706' y='464'>timestamp</text>
                        <title>&#10697; timestamp
                            * int</title>
                    </a>
                    <text x='795' y='460' text-anchor='end' class='colType'>&#35;</text>
                    <use x='685' y='471' xlink:href='#nn' />
                    <use x='686' y='470' xlink:href='#unq'>
                        <title>&#x1F50D; Unq pulse_values_type_key_hash_unique ( type, key_hash ) &#x1F50D;
                            pulse_values_type_index ( type ) </title>
                    </use><a xlink:href='#medlink.pulse_values.type'><text id='medlink&#46;pulse&#95;values&#46;type'
                            x='706' y='483'>type</text>
                        <title>&#10697; type
                            * varchar(255)</title>
                    </a>
                    <text x='795' y='479' text-anchor='end' class='colType'>t</text>
                    <use x='685' y='490' xlink:href='#nn' /><a xlink:href='#medlink.pulse_values.key'><text
                            id='medlink&#46;pulse&#95;values&#46;key' x='706' y='502'>key</text>
                        <title>&#10697; key
                            * mediumtext</title>
                    </a>
                    <text x='795' y='498' text-anchor='end' class='colType'>t</text>
                    <use x='686' y='508' xlink:href='#unq'>
                        <title>&#x1F50D; Unq pulse_values_type_key_hash_unique ( type, key_hash ) </title>
                    </use><a xlink:href='#medlink.pulse_values.key_hash'><text
                            id='medlink&#46;pulse&#95;values&#46;key&#95;hash' x='706' y='521'>key&#95;hash</text>
                        <title>&#10697; key_hash
                            binary(16)</title>
                    </a>
                    <text x='795' y='517' text-anchor='end' class='colType'>&#126;</text>
                    <use x='685' y='528' xlink:href='#nn' /><a xlink:href='#medlink.pulse_values.value'><text
                            id='medlink&#46;pulse&#95;values&#46;value' x='706' y='540'>value</text>
                        <title>&#10697; value
                            * mediumtext</title>
                    </a>
                    <text x='795' y='536' text-anchor='end' class='colType'>t</text>
                    <!-- == Table 'app_settings' == -->
                    <rect id='depict_medlink&#46;app&#95;settings' class='entity' style='stroke:#F9FAFC' x='152' y='599'
                        width='114' height='190' rx='4' ry='4' />
                    <rect x='152' y='599' width='114' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='152' y='603' width='114' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.app_settings'><text id='depict&#45;medlink&#46;app&#95;settings' x='168'
                            y='620' class='tableHeader' style='fill:#414348;'>app&#95;settings</text>
                        <title>Table medlink.app_settings</title>
                    </a>
                    <use x='153' y='642' xlink:href='#nn' />
                    <use x='154' y='641' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_app_settings ( id ) </title>
                    </use><a xlink:href='#medlink.app_settings.id'><text id='medlink&#46;app&#95;settings&#46;id'
                            x='174' y='654' class='colPk'>id</text>
                        <title>&#10697; id
                            * char(36)</title>
                    </a>
                    <text x='263' y='650' text-anchor='end' class='colType'>c</text> <a
                        xlink:href='#medlink.app_settings.tab'><text id='medlink&#46;app&#95;settings&#46;tab' x='174'
                            y='673'>tab</text>
                        <title>&#10697; tab
                            varchar(255)</title>
                    </a>
                    <text x='263' y='669' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.app_settings.key'><text id='medlink&#46;app&#95;settings&#46;key' x='174'
                            y='692'>key</text>
                        <title>&#10697; key
                            varchar(255)</title>
                    </a>
                    <text x='263' y='688' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.app_settings.default'><text id='medlink&#46;app&#95;settings&#46;default'
                            x='174' y='711'>default</text>
                        <title>&#10697; default
                            longtext</title>
                    </a>
                    <text x='263' y='707' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.app_settings.value'><text id='medlink&#46;app&#95;settings&#46;value'
                            x='174' y='730'>value</text>
                        <title>&#10697; value
                            longtext</title>
                    </a>
                    <text x='263' y='726' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.app_settings.created_at'><text
                            id='medlink&#46;app&#95;settings&#46;created&#95;at' x='174' y='749'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.app_settings.updated_at'><text
                            id='medlink&#46;app&#95;settings&#46;updated&#95;at' x='174' y='768'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'personal_access_tokens' == -->
                    <rect id='depict_medlink&#46;personal&#95;access&#95;tokens' class='entity' style='stroke:#F9FAFC'
                        x='399' y='580' width='171' height='247' rx='4' ry='4' />
                    <rect x='399' y='580' width='171' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BED3F4);' />
                    <rect x='399' y='584' width='171' height='29' style='stroke-width:0;fill:url(#tbg_BED3F4);' />
                    <a xlink:href='#medlink.personal_access_tokens'><text
                            id='depict&#45;medlink&#46;personal&#95;access&#95;tokens' x='411' y='601'
                            class='tableHeader' style='fill:#414348;'>personal&#95;access&#95;tokens</text>
                        <title>Table medlink.personal_access_tokens</title>
                    </a>
                    <use x='400' y='623' xlink:href='#nn' />
                    <use x='401' y='622' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_personal_access_tokens ( id ) </title>
                    </use><a xlink:href='#medlink.personal_access_tokens.id'><text
                            id='medlink&#46;personal&#95;access&#95;tokens&#46;id' x='421' y='635'
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='567' y='631' text-anchor='end' class='colType'>&#35;</text>
                    <use x='400' y='642' xlink:href='#nn' />
                    <use x='401' y='641' xlink:href='#idx'>
                        <title>&#x1F50D; personal_access_tokens_tokenable_type_tokenable_id_index ( tokenable_type,
                            tokenable_id ) </title>
                    </use><a xlink:href='#medlink.personal_access_tokens.tokenable_type'><text
                            id='medlink&#46;personal&#95;access&#95;tokens&#46;tokenable&#95;type' x='421'
                            y='654'>tokenable&#95;type</text>
                        <title>&#10697; tokenable_type
                            * varchar(255)</title>
                    </a>
                    <text x='567' y='650' text-anchor='end' class='colType'>t</text>
                    <use x='400' y='661' xlink:href='#nn' />
                    <use x='401' y='660' xlink:href='#idx'>
                        <title>&#x1F50D; personal_access_tokens_tokenable_type_tokenable_id_index ( tokenable_type,
                            tokenable_id ) </title>
                    </use><a xlink:href='#medlink.personal_access_tokens.tokenable_id'><text
                            id='medlink&#46;personal&#95;access&#95;tokens&#46;tokenable&#95;id' x='421'
                            y='673'>tokenable&#95;id</text>
                        <title>&#10697; tokenable_id
                            * bigint</title>
                    </a>
                    <text x='567' y='669' text-anchor='end' class='colType'>&#35;</text>
                    <use x='400' y='680' xlink:href='#nn' /><a xlink:href='#medlink.personal_access_tokens.name'><text
                            id='medlink&#46;personal&#95;access&#95;tokens&#46;name' x='421' y='692'>name</text>
                        <title>&#10697; name
                            * varchar(255)</title>
                    </a>
                    <text x='567' y='688' text-anchor='end' class='colType'>t</text>
                    <use x='400' y='699' xlink:href='#nn' />
                    <use x='401' y='698' xlink:href='#unq'>
                        <title>&#x1F50D; Unq personal_access_tokens_token_unique ( token ) </title>
                    </use><a xlink:href='#medlink.personal_access_tokens.token'><text
                            id='medlink&#46;personal&#95;access&#95;tokens&#46;token' x='421' y='711'>token</text>
                        <title>&#10697; token
                            * varchar(64)</title>
                    </a>
                    <text x='567' y='707' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.personal_access_tokens.abilities'><text
                            id='medlink&#46;personal&#95;access&#95;tokens&#46;abilities' x='421'
                            y='730'>abilities</text>
                        <title>&#10697; abilities
                            text</title>
                    </a>
                    <text x='567' y='726' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.personal_access_tokens.last_used_at'><text
                            id='medlink&#46;personal&#95;access&#95;tokens&#46;last&#95;used&#95;at' x='421'
                            y='749'>last&#95;used&#95;at</text>
                        <title>&#10697; last_used_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.personal_access_tokens.expires_at'><text
                            id='medlink&#46;personal&#95;access&#95;tokens&#46;expires&#95;at' x='421'
                            y='768'>expires&#95;at</text>
                        <title>&#10697; expires_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.personal_access_tokens.created_at'><text
                            id='medlink&#46;personal&#95;access&#95;tokens&#46;created&#95;at' x='421'
                            y='787'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.personal_access_tokens.updated_at'><text
                            id='medlink&#46;personal&#95;access&#95;tokens&#46;updated&#95;at' x='421'
                            y='806'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'transactions' == -->
                    <rect id='depict_medlink&#46;transactions' class='entity' style='stroke:#F9F9FC' x='893' y='276'
                        width='133' height='285' rx='4' ry='4' />
                    <rect x='893' y='276' width='133' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BEBEF4);' />
                    <rect x='893' y='280' width='133' height='29' style='stroke-width:0;fill:url(#tbg_BEBEF4);' />
                    <a xlink:href='#medlink.transactions'><text id='depict&#45;medlink&#46;transactions' x='920' y='297'
                            class='tableHeader' style='fill:#414148;'>transactions</text>
                        <title>Table medlink.transactions</title>
                    </a>
                    <use x='894' y='319' xlink:href='#nn' />
                    <use x='895' y='318' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_transactions ( id ) </title>
                    </use><a xlink:href='#medlink.transactions.id'><text id='medlink&#46;transactions&#46;id' x='915'
                            y='331'
                            onmouseover="hghl(['transfers_transfers_deposit_id_foreign','medlink.transfers.deposit_id','transfers_transfers_withdraw_id_foreign','medlink.transfers.withdraw_id'])"
                            onmouseout="uhghl(['transfers_transfers_deposit_id_foreign','medlink.transfers.deposit_id','transfers_transfers_withdraw_id_foreign','medlink.transfers.withdraw_id'])"
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint
                            &#8601; transfers( deposit_id )
                            &#8601; transfers( withdraw_id )</title>
                    </a>
                    <a xlink:href='#medlink.transactions.id'>
                        <use x='1012' y='318' xlink:href='#ref' />
                        <title>&#x1F517; Referred by transfers ( deposit_id -&gt; id )
                            Referred by transfers ( withdraw_id -&gt; id ) </title>
                    </a>
                    <use x='894' y='338' xlink:href='#nn' />
                    <use x='895' y='337' xlink:href='#idx'>
                        <title>&#x1F50D; payable_type_payable_id_ind ( payable_type, payable_id ) &#x1F50D;
                            payable_type_ind ( payable_type, payable_id, type ) &#x1F50D; payable_confirmed_ind (
                            payable_type, payable_id, confirmed ) &#x1F50D; payable_type_confirmed_ind ( payable_type,
                            payable_id, type, confirmed ) </title>
                    </use><a xlink:href='#medlink.transactions.payable_type'><text
                            id='medlink&#46;transactions&#46;payable&#95;type' x='915' y='350'>payable&#95;type</text>
                        <title>&#10697; payable_type
                            * varchar(255)</title>
                    </a>
                    <text x='1023' y='346' text-anchor='end' class='colType'>t</text>
                    <use x='894' y='357' xlink:href='#nn' />
                    <use x='895' y='356' xlink:href='#idx'>
                        <title>&#x1F50D; payable_type_payable_id_ind ( payable_type, payable_id ) &#x1F50D;
                            payable_type_ind ( payable_type, payable_id, type ) &#x1F50D; payable_confirmed_ind (
                            payable_type, payable_id, confirmed ) &#x1F50D; payable_type_confirmed_ind ( payable_type,
                            payable_id, type, confirmed ) </title>
                    </use><a xlink:href='#medlink.transactions.payable_id'><text
                            id='medlink&#46;transactions&#46;payable&#95;id' x='915' y='369'>payable&#95;id</text>
                        <title>&#10697; payable_id
                            * bigint</title>
                    </a>
                    <text x='1023' y='365' text-anchor='end' class='colType'>&#35;</text>
                    <use x='894' y='376' xlink:href='#nn' />
                    <use x='895' y='375' xlink:href='#idx'>
                        <title>&#x1F50D; transactions_wallet_id_foreign ( wallet_id ) </title>
                    </use><a xlink:href='#medlink.transactions.wallet_id'><text
                            id='medlink&#46;transactions&#46;wallet&#95;id' x='915' y='388'
                            onmouseover="hghl(['transactions_transactions_wallet_id_foreign','medlink.wallets.id'])"
                            onmouseout="uhghl(['transactions_transactions_wallet_id_foreign','medlink.wallets.id'])">wallet&#95;id</text>
                        <title>&#10697; wallet_id
                            * bigint
                            &#8599; wallets( id )</title>
                    </a>
                    <a xlink:href='#medlink.transactions.wallet_id'>
                        <use x='1012' y='375' xlink:href='#fk' />
                        <title>&#x1F517; References wallets ( wallet_id -&gt; id ) </title>
                    </a>
                    <use x='894' y='395' xlink:href='#nn' />
                    <use x='895' y='394' xlink:href='#idx'>
                        <title>&#x1F50D; payable_type_ind ( payable_type, payable_id, type ) &#x1F50D;
                            payable_type_confirmed_ind ( payable_type, payable_id, type, confirmed ) &#x1F50D;
                            transactions_type_index ( type ) </title>
                    </use><a xlink:href='#medlink.transactions.type'><text id='medlink&#46;transactions&#46;type'
                            x='915' y='407'>type</text>
                        <title>&#10697; type
                            * enum(&apos;deposit&apos;,&apos;withdraw&apos;)</title>
                    </a>
                    <text x='1023' y='403' text-anchor='end' class='colType'>t</text>
                    <use x='894' y='414' xlink:href='#nn' /><a xlink:href='#medlink.transactions.amount'><text
                            id='medlink&#46;transactions&#46;amount' x='915' y='426'>amount</text>
                        <title>&#10697; amount
                            * decimal(64,0)</title>
                    </a>
                    <text x='1023' y='422' text-anchor='end' class='colType'>&#35;</text>
                    <use x='894' y='433' xlink:href='#nn' />
                    <use x='895' y='432' xlink:href='#idx'>
                        <title>&#x1F50D; payable_confirmed_ind ( payable_type, payable_id, confirmed ) &#x1F50D;
                            payable_type_confirmed_ind ( payable_type, payable_id, type, confirmed ) </title>
                    </use><a xlink:href='#medlink.transactions.confirmed'><text
                            id='medlink&#46;transactions&#46;confirmed' x='915' y='445'>confirmed</text>
                        <title>&#10697; confirmed
                            * boolean</title>
                    </a>
                    <text x='1023' y='441' text-anchor='end' class='colType'>b</text> <text x='896'
                        y='464'>&#9654;</text><a xlink:href='#medlink.transactions.meta'><text
                            id='medlink&#46;transactions&#46;meta' x='915' y='464'>meta</text>
                        <title>&#10697; meta
                            json</title>
                    </a>
                    <use x='894' y='471' xlink:href='#nn' />
                    <use x='895' y='470' xlink:href='#unq'>
                        <title>&#x1F50D; Unq transactions_uuid_unique ( uuid ) </title>
                    </use><a xlink:href='#medlink.transactions.uuid'><text id='medlink&#46;transactions&#46;uuid'
                            x='915' y='483'>uuid</text>
                        <title>&#10697; uuid
                            * char(36)</title>
                    </a>
                    <text x='1023' y='479' text-anchor='end' class='colType'>c</text> <a
                        xlink:href='#medlink.transactions.created_at'><text
                            id='medlink&#46;transactions&#46;created&#95;at' x='915' y='502'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.transactions.updated_at'><text
                            id='medlink&#46;transactions&#46;updated&#95;at' x='915' y='521'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.transactions.deleted_at'><text
                            id='medlink&#46;transactions&#46;deleted&#95;at' x='915' y='540'>deleted&#95;at</text>
                        <title>&#10697; deleted_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'wallets' == -->
                    <rect id='depict_medlink&#46;wallets' class='entity' style='stroke:#F9F9FC' x='1102' y='542'
                        width='152' height='304' rx='4' ry='4' />
                    <rect x='1102' y='542' width='152' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BEBEF4);' />
                    <rect x='1102' y='546' width='152' height='29' style='stroke-width:0;fill:url(#tbg_BEBEF4);' />
                    <a xlink:href='#medlink.wallets'><text id='depict&#45;medlink&#46;wallets' x='1154' y='563'
                            class='tableHeader' style='fill:#414148;'>wallets</text>
                        <title>Table medlink.wallets</title>
                    </a>
                    <use x='1103' y='585' xlink:href='#nn' />
                    <use x='1104' y='584' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_wallets ( id ) </title>
                    </use><a xlink:href='#medlink.wallets.id'><text id='medlink&#46;wallets&#46;id' x='1124' y='597'
                            onmouseover="hghl(['transactions_transactions_wallet_id_foreign','medlink.transactions.wallet_id'])"
                            onmouseout="uhghl(['transactions_transactions_wallet_id_foreign','medlink.transactions.wallet_id'])"
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint
                            &#8601; transactions( wallet_id )</title>
                    </a>
                    <a xlink:href='#medlink.wallets.id'>
                        <use x='1240' y='584' xlink:href='#ref' />
                        <title>&#x1F517; Referred by transactions ( wallet_id -&gt; id ) </title>
                    </a>
                    <use x='1103' y='604' xlink:href='#nn' />
                    <use x='1104' y='603' xlink:href='#unq'>
                        <title>&#x1F50D; Unq wallets_holder_type_holder_id_slug_unique ( holder_type, holder_id, slug )
                            &#x1F50D; wallets_holder_type_holder_id_index ( holder_type, holder_id ) </title>
                    </use><a xlink:href='#medlink.wallets.holder_type'><text
                            id='medlink&#46;wallets&#46;holder&#95;type' x='1124' y='616'>holder&#95;type</text>
                        <title>&#10697; holder_type
                            * varchar(255)</title>
                    </a>
                    <text x='1251' y='612' text-anchor='end' class='colType'>t</text>
                    <use x='1103' y='623' xlink:href='#nn' />
                    <use x='1104' y='622' xlink:href='#unq'>
                        <title>&#x1F50D; Unq wallets_holder_type_holder_id_slug_unique ( holder_type, holder_id, slug )
                            &#x1F50D; wallets_holder_type_holder_id_index ( holder_type, holder_id ) </title>
                    </use><a xlink:href='#medlink.wallets.holder_id'><text id='medlink&#46;wallets&#46;holder&#95;id'
                            x='1124' y='635'>holder&#95;id</text>
                        <title>&#10697; holder_id
                            * bigint</title>
                    </a>
                    <text x='1251' y='631' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1103' y='642' xlink:href='#nn' /><a xlink:href='#medlink.wallets.name'><text
                            id='medlink&#46;wallets&#46;name' x='1124' y='654'>name</text>
                        <title>&#10697; name
                            * varchar(255)</title>
                    </a>
                    <text x='1251' y='650' text-anchor='end' class='colType'>t</text>
                    <use x='1103' y='661' xlink:href='#nn' />
                    <use x='1104' y='660' xlink:href='#unq'>
                        <title>&#x1F50D; Unq wallets_holder_type_holder_id_slug_unique ( holder_type, holder_id, slug )
                            &#x1F50D; wallets_slug_index ( slug ) </title>
                    </use><a xlink:href='#medlink.wallets.slug'><text id='medlink&#46;wallets&#46;slug' x='1124'
                            y='673'>slug</text>
                        <title>&#10697; slug
                            * varchar(255)</title>
                    </a>
                    <text x='1251' y='669' text-anchor='end' class='colType'>t</text>
                    <use x='1103' y='680' xlink:href='#nn' />
                    <use x='1104' y='679' xlink:href='#unq'>
                        <title>&#x1F50D; Unq wallets_uuid_unique ( uuid ) </title>
                    </use><a xlink:href='#medlink.wallets.uuid'><text id='medlink&#46;wallets&#46;uuid' x='1124'
                            y='692'>uuid</text>
                        <title>&#10697; uuid
                            * char(36)</title>
                    </a>
                    <text x='1251' y='688' text-anchor='end' class='colType'>c</text> <a
                        xlink:href='#medlink.wallets.description'><text id='medlink&#46;wallets&#46;description'
                            x='1124' y='711'>description</text>
                        <title>&#10697; description
                            varchar(255)</title>
                    </a>
                    <text x='1251' y='707' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.wallets.meta'><text id='medlink&#46;wallets&#46;meta' x='1124'
                            y='730'>meta</text>
                        <title>&#10697; meta
                            json</title>
                    </a>
                    <use x='1103' y='737' xlink:href='#nn' /><a xlink:href='#medlink.wallets.balance'><text
                            id='medlink&#46;wallets&#46;balance' x='1124' y='749'>balance</text>
                        <title>&#10697; balance
                            * decimal(64,0) default &apos;0&apos;</title>
                    </a>
                    <text x='1251' y='745' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1103' y='756' xlink:href='#nn' /><a xlink:href='#medlink.wallets.decimal_places'><text
                            id='medlink&#46;wallets&#46;decimal&#95;places' x='1124' y='768'>decimal&#95;places</text>
                        <title>&#10697; decimal_places
                            * smallint default &apos;2&apos;</title>
                    </a>
                    <text x='1251' y='764' text-anchor='end' class='colType'>&#35;</text> <a
                        xlink:href='#medlink.wallets.created_at'><text id='medlink&#46;wallets&#46;created&#95;at'
                            x='1124' y='787'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.wallets.updated_at'><text id='medlink&#46;wallets&#46;updated&#95;at'
                            x='1124' y='806'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.wallets.deleted_at'><text id='medlink&#46;wallets&#46;deleted&#95;at'
                            x='1124' y='825'>deleted&#95;at</text>
                        <title>&#10697; deleted_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'transaction_histories' == -->
                    <rect id='depict_medlink&#46;transaction&#95;histories' class='entity' style='stroke:#F9F9FC'
                        x='912' y='599' width='152' height='209' rx='4' ry='4' />
                    <rect x='912' y='599' width='152' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BEBEF4);' />
                    <rect x='912' y='603' width='152' height='29' style='stroke-width:0;fill:url(#tbg_BEBEF4);' />
                    <a xlink:href='#medlink.transaction_histories'><text
                            id='depict&#45;medlink&#46;transaction&#95;histories' x='924' y='620' class='tableHeader'
                            style='fill:#414148;'>transaction&#95;histories</text>
                        <title>Table medlink.transaction_histories</title>
                    </a>
                    <use x='913' y='642' xlink:href='#nn' />
                    <use x='914' y='641' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_transaction_histories ( id ) </title>
                    </use><a xlink:href='#medlink.transaction_histories.id'><text
                            id='medlink&#46;transaction&#95;histories&#46;id' x='934' y='654' class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='1061' y='650' text-anchor='end' class='colType'>&#35;</text>
                    <use x='913' y='661' xlink:href='#nn' />
                    <use x='914' y='660' xlink:href='#idx'>
                        <title>&#x1F50D; transaction_histories_user_id_foreign ( user_id ) </title>
                    </use><a xlink:href='#medlink.transaction_histories.user_id'><text
                            id='medlink&#46;transaction&#95;histories&#46;user&#95;id' x='934' y='673'
                            onmouseover="hghl(['transaction_histories_transaction_histories_user_id_foreign','medlink.users.id'])"
                            onmouseout="uhghl(['transaction_histories_transaction_histories_user_id_foreign','medlink.users.id'])">user&#95;id</text>
                        <title>&#10697; user_id
                            * bigint
                            &#8599; users( id )</title>
                    </a>
                    <a xlink:href='#medlink.transaction_histories.user_id'>
                        <use x='1050' y='660' xlink:href='#fk' />
                        <title>&#x1F517; References users ( user_id -&gt; id ) </title>
                    </a>
                    <use x='913' y='680' xlink:href='#nn' /><a xlink:href='#medlink.transaction_histories.reason'><text
                            id='medlink&#46;transaction&#95;histories&#46;reason' x='934' y='692'>reason</text>
                        <title>&#10697; reason
                            * varchar(255)</title>
                    </a>
                    <text x='1061' y='688' text-anchor='end' class='colType'>t</text>
                    <use x='913' y='699' xlink:href='#nn' /><a xlink:href='#medlink.transaction_histories.amount'><text
                            id='medlink&#46;transaction&#95;histories&#46;amount' x='934' y='711'>amount</text>
                        <title>&#10697; amount
                            * double</title>
                    </a>
                    <text x='1061' y='707' text-anchor='end' class='colType'>&#35;</text>
                    <use x='913' y='718' xlink:href='#nn' /><a xlink:href='#medlink.transaction_histories.type'><text
                            id='medlink&#46;transaction&#95;histories&#46;type' x='934' y='730'>type</text>
                        <title>&#10697; type
                            * enum(&apos;deposit&apos;,&apos;withdraw&apos;)</title>
                    </a>
                    <text x='1061' y='726' text-anchor='end' class='colType'>t</text>
                    <use x='913' y='737' xlink:href='#nn' /><a xlink:href='#medlink.transaction_histories.status'><text
                            id='medlink&#46;transaction&#95;histories&#46;status' x='934' y='749'>status</text>
                        <title>&#10697; status
                            * enum(&apos;pending&apos;,&apos;success&apos;) default &apos;pending&apos;</title>
                    </a>
                    <text x='1061' y='745' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.transaction_histories.created_at'><text
                            id='medlink&#46;transaction&#95;histories&#46;created&#95;at' x='934'
                            y='768'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.transaction_histories.updated_at'><text
                            id='medlink&#46;transaction&#95;histories&#46;updated&#95;at' x='934'
                            y='787'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'transfers' == -->
                    <rect id='depict_medlink&#46;transfers' class='entity' style='stroke:#F9F9FC' x='1140' y='181'
                        width='133' height='323' rx='4' ry='4' />
                    <rect x='1140' y='181' width='133' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_BEBEF4);' />
                    <rect x='1140' y='185' width='133' height='29' style='stroke-width:0;fill:url(#tbg_BEBEF4);' />
                    <a xlink:href='#medlink.transfers'><text id='depict&#45;medlink&#46;transfers' x='1177' y='202'
                            class='tableHeader' style='fill:#414148;'>transfers</text>
                        <title>Table medlink.transfers</title>
                    </a>
                    <use x='1141' y='224' xlink:href='#nn' />
                    <use x='1142' y='223' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_transfers ( id ) </title>
                    </use><a xlink:href='#medlink.transfers.id'><text id='medlink&#46;transfers&#46;id' x='1162' y='236'
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='1270' y='232' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1141' y='243' xlink:href='#nn' />
                    <use x='1142' y='242' xlink:href='#idx'>
                        <title>&#x1F50D; transfers_from_id_index ( from_id ) </title>
                    </use><a xlink:href='#medlink.transfers.from_id'><text id='medlink&#46;transfers&#46;from&#95;id'
                            x='1162' y='255'>from&#95;id</text>
                        <title>&#10697; from_id
                            * bigint</title>
                    </a>
                    <text x='1270' y='251' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1141' y='262' xlink:href='#nn' />
                    <use x='1142' y='261' xlink:href='#idx'>
                        <title>&#x1F50D; transfers_to_id_index ( to_id ) </title>
                    </use><a xlink:href='#medlink.transfers.to_id'><text id='medlink&#46;transfers&#46;to&#95;id'
                            x='1162' y='274'>to&#95;id</text>
                        <title>&#10697; to_id
                            * bigint</title>
                    </a>
                    <text x='1270' y='270' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1141' y='281' xlink:href='#nn' /><a xlink:href='#medlink.transfers.status'><text
                            id='medlink&#46;transfers&#46;status' x='1162' y='293'>status</text>
                        <title>&#10697; status
                            *
                            enum(&apos;exchange&apos;,&apos;transfer&apos;,&apos;paid&apos;,&apos;refund&apos;,&apos;gift&apos;)
                            default &apos;transfer&apos;</title>
                    </a>
                    <text x='1270' y='289' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.transfers.status_last'><text id='medlink&#46;transfers&#46;status&#95;last'
                            x='1162' y='312'>status&#95;last</text>
                        <title>&#10697; status_last
                            enum(&apos;exchange&apos;,&apos;transfer&apos;,&apos;paid&apos;,&apos;refund&apos;,&apos;gift&apos;)
                        </title>
                    </a>
                    <text x='1270' y='308' text-anchor='end' class='colType'>t</text>
                    <use x='1141' y='319' xlink:href='#nn' />
                    <use x='1142' y='318' xlink:href='#idx'>
                        <title>&#x1F50D; transfers_deposit_id_foreign ( deposit_id ) </title>
                    </use><a xlink:href='#medlink.transfers.deposit_id'><text
                            id='medlink&#46;transfers&#46;deposit&#95;id' x='1162' y='331'
                            onmouseover="hghl(['transfers_transfers_deposit_id_foreign','medlink.transactions.id'])"
                            onmouseout="uhghl(['transfers_transfers_deposit_id_foreign','medlink.transactions.id'])">deposit&#95;id</text>
                        <title>&#10697; deposit_id
                            * bigint
                            &#8599; transactions( id )</title>
                    </a>
                    <a xlink:href='#medlink.transfers.deposit_id'>
                        <use x='1259' y='318' xlink:href='#fk' />
                        <title>&#x1F517; References transactions ( deposit_id -&gt; id ) </title>
                    </a>
                    <use x='1141' y='338' xlink:href='#nn' />
                    <use x='1142' y='337' xlink:href='#idx'>
                        <title>&#x1F50D; transfers_withdraw_id_foreign ( withdraw_id ) </title>
                    </use><a xlink:href='#medlink.transfers.withdraw_id'><text
                            id='medlink&#46;transfers&#46;withdraw&#95;id' x='1162' y='350'
                            onmouseover="hghl(['transfers_transfers_withdraw_id_foreign','medlink.transactions.id'])"
                            onmouseout="uhghl(['transfers_transfers_withdraw_id_foreign','medlink.transactions.id'])">withdraw&#95;id</text>
                        <title>&#10697; withdraw_id
                            * bigint
                            &#8599; transactions( id )</title>
                    </a>
                    <a xlink:href='#medlink.transfers.withdraw_id'>
                        <use x='1259' y='337' xlink:href='#fk' />
                        <title>&#x1F517; References transactions ( withdraw_id -&gt; id ) </title>
                    </a>
                    <use x='1141' y='357' xlink:href='#nn' /><a xlink:href='#medlink.transfers.discount'><text
                            id='medlink&#46;transfers&#46;discount' x='1162' y='369'>discount</text>
                        <title>&#10697; discount
                            * decimal(64,0) default &apos;0&apos;</title>
                    </a>
                    <text x='1270' y='365' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1141' y='376' xlink:href='#nn' /><a xlink:href='#medlink.transfers.fee'><text
                            id='medlink&#46;transfers&#46;fee' x='1162' y='388'>fee</text>
                        <title>&#10697; fee
                            * decimal(64,0) default &apos;0&apos;</title>
                    </a>
                    <text x='1270' y='384' text-anchor='end' class='colType'>&#35;</text> <a
                        xlink:href='#medlink.transfers.extra'><text id='medlink&#46;transfers&#46;extra' x='1162'
                            y='407'>extra</text>
                        <title>&#10697; extra
                            json</title>
                    </a>
                    <use x='1141' y='414' xlink:href='#nn' />
                    <use x='1142' y='413' xlink:href='#unq'>
                        <title>&#x1F50D; Unq transfers_uuid_unique ( uuid ) </title>
                    </use><a xlink:href='#medlink.transfers.uuid'><text id='medlink&#46;transfers&#46;uuid' x='1162'
                            y='426'>uuid</text>
                        <title>&#10697; uuid
                            * char(36)</title>
                    </a>
                    <text x='1270' y='422' text-anchor='end' class='colType'>c</text> <a
                        xlink:href='#medlink.transfers.created_at'><text id='medlink&#46;transfers&#46;created&#95;at'
                            x='1162' y='445'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.transfers.updated_at'><text id='medlink&#46;transfers&#46;updated&#95;at'
                            x='1162' y='464'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.transfers.deleted_at'><text id='medlink&#46;transfers&#46;deleted&#95;at'
                            x='1162' y='483'>deleted&#95;at</text>
                        <title>&#10697; deleted_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'user_languages' == -->
                    <rect id='depict_medlink&#46;user&#95;languages' class='entity' style='stroke:#FCFAF9' x='380'
                        y='922' width='133' height='152' rx='4' ry='4' />
                    <rect x='380' y='922' width='133' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_F7F2EC);' />
                    <rect x='380' y='926' width='133' height='29' style='stroke-width:0;fill:url(#tbg_F7F2EC);' />
                    <a xlink:href='#medlink.user_languages'><text id='depict&#45;medlink&#46;user&#95;languages' x='397'
                            y='943' class='tableHeader' style='fill:#484441;'>user&#95;languages</text>
                        <title>Table medlink.user_languages</title>
                    </a>
                    <use x='381' y='965' xlink:href='#nn' />
                    <use x='382' y='964' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_user_languages ( id ) </title>
                    </use><a xlink:href='#medlink.user_languages.id'><text id='medlink&#46;user&#95;languages&#46;id'
                            x='402' y='977' class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='510' y='973' text-anchor='end' class='colType'>&#35;</text>
                    <use x='381' y='984' xlink:href='#nn' />
                    <use x='382' y='983' xlink:href='#idx'>
                        <title>&#x1F50D; user_languages_user_id_foreign ( user_id ) </title>
                    </use><a xlink:href='#medlink.user_languages.user_id'><text
                            id='medlink&#46;user&#95;languages&#46;user&#95;id' x='402' y='996'
                            onmouseover="hghl(['user_languages_user_languages_user_id_foreign','medlink.users.id'])"
                            onmouseout="uhghl(['user_languages_user_languages_user_id_foreign','medlink.users.id'])">user&#95;id</text>
                        <title>&#10697; user_id
                            * bigint
                            &#8599; users( id )</title>
                    </a>
                    <a xlink:href='#medlink.user_languages.user_id'>
                        <use x='499' y='983' xlink:href='#fk' />
                        <title>&#x1F517; References users ( user_id -&gt; id ) </title>
                    </a>
                    <use x='381' y='1003' xlink:href='#nn' />
                    <use x='382' y='1002' xlink:href='#idx'>
                        <title>&#x1F50D; user_languages_language_id_foreign ( language_id ) </title>
                    </use><a xlink:href='#medlink.user_languages.language_id'><text
                            id='medlink&#46;user&#95;languages&#46;language&#95;id' x='402' y='1015'
                            onmouseover="hghl(['user_languages_user_languages_language_id_foreign','medlink.languages.id'])"
                            onmouseout="uhghl(['user_languages_user_languages_language_id_foreign','medlink.languages.id'])">language&#95;id</text>
                        <title>&#10697; language_id
                            * bigint
                            &#8599; languages( id )</title>
                    </a>
                    <a xlink:href='#medlink.user_languages.language_id'>
                        <use x='499' y='1002' xlink:href='#fk' />
                        <title>&#x1F517; References languages ( language_id -&gt; id ) </title>
                    </a>
                    <a xlink:href='#medlink.user_languages.created_at'><text
                            id='medlink&#46;user&#95;languages&#46;created&#95;at' x='402'
                            y='1034'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.user_languages.updated_at'><text
                            id='medlink&#46;user&#95;languages&#46;updated&#95;at' x='402'
                            y='1053'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'languages' == -->
                    <rect id='depict_medlink&#46;languages' class='entity' style='stroke:#FCFAF9' x='152' y='922'
                        width='114' height='152' rx='4' ry='4' />
                    <rect x='152' y='922' width='114' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_F7F2EC);' />
                    <rect x='152' y='926' width='114' height='29' style='stroke-width:0;fill:url(#tbg_F7F2EC);' />
                    <a xlink:href='#medlink.languages'><text id='depict&#45;medlink&#46;languages' x='175' y='943'
                            class='tableHeader' style='fill:#484441;'>languages</text>
                        <title>Table medlink.languages</title>
                    </a>
                    <use x='153' y='965' xlink:href='#nn' />
                    <use x='154' y='964' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_languages ( id ) </title>
                    </use><a xlink:href='#medlink.languages.id'><text id='medlink&#46;languages&#46;id' x='174' y='977'
                            onmouseover="hghl(['user_languages_user_languages_language_id_foreign','medlink.user_languages.language_id'])"
                            onmouseout="uhghl(['user_languages_user_languages_language_id_foreign','medlink.user_languages.language_id'])"
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint
                            &#8601; user_languages( language_id )</title>
                    </a>
                    <a xlink:href='#medlink.languages.id'>
                        <use x='252' y='964' xlink:href='#ref' />
                        <title>&#x1F517; Referred by user_languages ( language_id -&gt; id ) </title>
                    </a>
                    <use x='153' y='984' xlink:href='#nn' />
                    <use x='154' y='983' xlink:href='#unq'>
                        <title>&#x1F50D; Unq languages_name_unique ( name ) </title>
                    </use><a xlink:href='#medlink.languages.name'><text id='medlink&#46;languages&#46;name' x='174'
                            y='996'>name</text>
                        <title>&#10697; name
                            * varchar(255)</title>
                    </a>
                    <text x='263' y='992' text-anchor='end' class='colType'>t</text>
                    <use x='153' y='1003' xlink:href='#nn' />
                    <use x='154' y='1002' xlink:href='#unq'>
                        <title>&#x1F50D; Unq languages_code_unique ( code ) </title>
                    </use><a xlink:href='#medlink.languages.code'><text id='medlink&#46;languages&#46;code' x='174'
                            y='1015'>code</text>
                        <title>&#10697; code
                            * varchar(255)</title>
                    </a>
                    <text x='263' y='1011' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.languages.created_at'><text id='medlink&#46;languages&#46;created&#95;at'
                            x='174' y='1034'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.languages.updated_at'><text id='medlink&#46;languages&#46;updated&#95;at'
                            x='174' y='1053'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'supports' == -->
                    <rect id='depict_medlink&#46;supports' class='entity' style='stroke:#FCFAF9' x='399' y='1112'
                        width='152' height='190' rx='4' ry='4' />
                    <rect x='399' y='1112' width='152' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_F7F2EC);' />
                    <rect x='399' y='1116' width='152' height='29' style='stroke-width:0;fill:url(#tbg_F7F2EC);' />
                    <a xlink:href='#medlink.supports'><text id='depict&#45;medlink&#46;supports' x='445' y='1133'
                            class='tableHeader' style='fill:#484441;'>supports</text>
                        <title>Table medlink.supports</title>
                    </a>
                    <use x='400' y='1155' xlink:href='#nn' />
                    <use x='401' y='1154' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_supports ( id ) </title>
                    </use><a xlink:href='#medlink.supports.id'><text id='medlink&#46;supports&#46;id' x='421' y='1167'
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='548' y='1163' text-anchor='end' class='colType'>&#35;</text>
                    <use x='400' y='1174' xlink:href='#nn' />
                    <use x='401' y='1173' xlink:href='#idx'>
                        <title>&#x1F50D; supports_user_id_foreign ( user_id ) </title>
                    </use><a xlink:href='#medlink.supports.user_id'><text id='medlink&#46;supports&#46;user&#95;id'
                            x='421' y='1186'
                            onmouseover="hghl(['supports_supports_user_id_foreign','medlink.users.id'])"
                            onmouseout="uhghl(['supports_supports_user_id_foreign','medlink.users.id'])">user&#95;id</text>
                        <title>&#10697; user_id
                            * bigint
                            &#8599; users( id )</title>
                    </a>
                    <a xlink:href='#medlink.supports.user_id'>
                        <use x='537' y='1173' xlink:href='#fk' />
                        <title>&#x1F517; References users ( user_id -&gt; id ) </title>
                    </a>
                    <a xlink:href='#medlink.supports.appointment_id'><text
                            id='medlink&#46;supports&#46;appointment&#95;id' x='421' y='1205'>appointment&#95;id</text>
                        <title>&#10697; appointment_id
                            bigint</title>
                    </a>
                    <text x='548' y='1201' text-anchor='end' class='colType'>&#35;</text>
                    <use x='400' y='1212' xlink:href='#nn' /><a xlink:href='#medlink.supports.message'><text
                            id='medlink&#46;supports&#46;message' x='421' y='1224'>message</text>
                        <title>&#10697; message
                            * text</title>
                    </a>
                    <text x='548' y='1220' text-anchor='end' class='colType'>t</text>
                    <use x='400' y='1231' xlink:href='#nn' /><a xlink:href='#medlink.supports.status'><text
                            id='medlink&#46;supports&#46;status' x='421' y='1243'>status</text>
                        <title>&#10697; status
                            * enum(&apos;open&apos;,&apos;closed&apos;) default &apos;open&apos;</title>
                    </a>
                    <text x='548' y='1239' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.supports.created_at'><text id='medlink&#46;supports&#46;created&#95;at'
                            x='421' y='1262'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.supports.updated_at'><text id='medlink&#46;supports&#46;updated&#95;at'
                            x='421' y='1281'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'user_settings' == -->
                    <rect id='depict_medlink&#46;user&#95;settings' class='entity' style='stroke:#FCFAF9' x='171'
                        y='1150' width='114' height='190' rx='4' ry='4' />
                    <rect x='171' y='1150' width='114' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_F7F2EC);' />
                    <rect x='171' y='1154' width='114' height='29' style='stroke-width:0;fill:url(#tbg_F7F2EC);' />
                    <a xlink:href='#medlink.user_settings'><text id='depict&#45;medlink&#46;user&#95;settings' x='186'
                            y='1171' class='tableHeader' style='fill:#484441;'>user&#95;settings</text>
                        <title>Table medlink.user_settings</title>
                    </a>
                    <use x='172' y='1193' xlink:href='#nn' />
                    <use x='173' y='1192' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_user_settings ( id ) </title>
                    </use><a xlink:href='#medlink.user_settings.id'><text id='medlink&#46;user&#95;settings&#46;id'
                            x='193' y='1205' class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='282' y='1201' text-anchor='end' class='colType'>&#35;</text>
                    <use x='172' y='1212' xlink:href='#nn' />
                    <use x='173' y='1211' xlink:href='#idx'>
                        <title>&#x1F50D; user_settings_user_id_foreign ( user_id ) </title>
                    </use><a xlink:href='#medlink.user_settings.user_id'><text
                            id='medlink&#46;user&#95;settings&#46;user&#95;id' x='193' y='1224'
                            onmouseover="hghl(['user_settings_user_settings_user_id_foreign','medlink.users.id'])"
                            onmouseout="uhghl(['user_settings_user_settings_user_id_foreign','medlink.users.id'])">user&#95;id</text>
                        <title>&#10697; user_id
                            * bigint
                            &#8599; users( id )</title>
                    </a>
                    <a xlink:href='#medlink.user_settings.user_id'>
                        <use x='271' y='1211' xlink:href='#fk' />
                        <title>&#x1F517; References users ( user_id -&gt; id ) </title>
                    </a>
                    <use x='172' y='1231' xlink:href='#nn' /><a xlink:href='#medlink.user_settings.name'><text
                            id='medlink&#46;user&#95;settings&#46;name' x='193' y='1243'>name</text>
                        <title>&#10697; name
                            * varchar(255)</title>
                    </a>
                    <text x='282' y='1239' text-anchor='end' class='colType'>t</text>
                    <use x='172' y='1250' xlink:href='#nn' /><a xlink:href='#medlink.user_settings.value'><text
                            id='medlink&#46;user&#95;settings&#46;value' x='193' y='1262'>value</text>
                        <title>&#10697; value
                            * boolean</title>
                    </a>
                    <text x='282' y='1258' text-anchor='end' class='colType'>b</text> <a
                        xlink:href='#medlink.user_settings.description'><text
                            id='medlink&#46;user&#95;settings&#46;description' x='193' y='1281'>description</text>
                        <title>&#10697; description
                            text</title>
                    </a>
                    <text x='282' y='1277' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.user_settings.created_at'><text
                            id='medlink&#46;user&#95;settings&#46;created&#95;at' x='193' y='1300'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.user_settings.updated_at'><text
                            id='medlink&#46;user&#95;settings&#46;updated&#95;at' x='193' y='1319'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'favorites' == -->
                    <rect id='depict_medlink&#46;favorites' class='entity' style='stroke:#FCFAF9' x='361' y='1359'
                        width='114' height='171' rx='4' ry='4' />
                    <rect x='361' y='1359' width='114' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_F7F2EC);' />
                    <rect x='361' y='1363' width='114' height='29' style='stroke-width:0;fill:url(#tbg_F7F2EC);' />
                    <a xlink:href='#medlink.favorites'><text id='depict&#45;medlink&#46;favorites' x='389' y='1380'
                            class='tableHeader' style='fill:#484441;'>favorites</text>
                        <title>Table medlink.favorites</title>
                    </a>
                    <use x='362' y='1402' xlink:href='#nn' />
                    <use x='363' y='1401' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_favorites ( id ) </title>
                    </use><a xlink:href='#medlink.favorites.id'><text id='medlink&#46;favorites&#46;id' x='383' y='1414'
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='472' y='1410' text-anchor='end' class='colType'>&#35;</text>
                    <use x='362' y='1421' xlink:href='#nn' /><a xlink:href='#medlink.favorites.type'><text
                            id='medlink&#46;favorites&#46;type' x='383' y='1433'>type</text>
                        <title>&#10697; type
                            * enum(&apos;doctor&apos;,&apos;patient&apos;) default &apos;doctor&apos;</title>
                    </a>
                    <text x='472' y='1429' text-anchor='end' class='colType'>t</text>
                    <use x='362' y='1440' xlink:href='#nn' />
                    <use x='363' y='1439' xlink:href='#idx'>
                        <title>&#x1F50D; favorites_patient_id_foreign ( patient_id ) </title>
                    </use><a xlink:href='#medlink.favorites.patient_id'><text
                            id='medlink&#46;favorites&#46;patient&#95;id' x='383' y='1452'
                            onmouseover="hghl(['favorites_favorites_patient_id_foreign','medlink.users.id'])"
                            onmouseout="uhghl(['favorites_favorites_patient_id_foreign','medlink.users.id'])">patient&#95;id</text>
                        <title>&#10697; patient_id
                            * bigint
                            &#8599; users( id )</title>
                    </a>
                    <a xlink:href='#medlink.favorites.patient_id'>
                        <use x='461' y='1439' xlink:href='#fk' />
                        <title>&#x1F517; References users ( patient_id -&gt; id ) </title>
                    </a>
                    <use x='362' y='1459' xlink:href='#nn' />
                    <use x='363' y='1458' xlink:href='#idx'>
                        <title>&#x1F50D; favorites_doctor_id_foreign ( doctor_id ) </title>
                    </use><a xlink:href='#medlink.favorites.doctor_id'><text
                            id='medlink&#46;favorites&#46;doctor&#95;id' x='383' y='1471'
                            onmouseover="hghl(['favorites_favorites_doctor_id_foreign','medlink.users.id'])"
                            onmouseout="uhghl(['favorites_favorites_doctor_id_foreign','medlink.users.id'])">doctor&#95;id</text>
                        <title>&#10697; doctor_id
                            * bigint
                            &#8599; users( id )</title>
                    </a>
                    <a xlink:href='#medlink.favorites.doctor_id'>
                        <use x='461' y='1458' xlink:href='#fk' />
                        <title>&#x1F517; References users ( doctor_id -&gt; id ) </title>
                    </a>
                    <a xlink:href='#medlink.favorites.created_at'><text id='medlink&#46;favorites&#46;created&#95;at'
                            x='383' y='1490'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.favorites.updated_at'><text id='medlink&#46;favorites&#46;updated&#95;at'
                            x='383' y='1509'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'user_insurances' == -->
                    <rect id='depict_medlink&#46;user&#95;insurances' class='entity' style='stroke:#F9F9FC' x='836'
                        y='1112' width='171' height='285' rx='4' ry='4' />
                    <rect x='836' y='1112' width='171' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_4D66CC);' />
                    <rect x='836' y='1116' width='171' height='29' style='stroke-width:0;fill:url(#tbg_4D66CC);' />
                    <a xlink:href='#medlink.user_insurances'><text id='depict&#45;medlink&#46;user&#95;insurances'
                            x='871' y='1133' class='tableHeader' style='fill:#414248;'>user&#95;insurances</text>
                        <title>Table medlink.user_insurances</title>
                    </a>
                    <use x='837' y='1155' xlink:href='#nn' />
                    <use x='838' y='1154' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_user_insurances ( id ) </title>
                    </use><a xlink:href='#medlink.user_insurances.id'><text id='medlink&#46;user&#95;insurances&#46;id'
                            x='858' y='1167' class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='1004' y='1163' text-anchor='end' class='colType'>&#35;</text>
                    <use x='837' y='1174' xlink:href='#nn' />
                    <use x='838' y='1173' xlink:href='#unq'>
                        <title>&#x1F50D; Unq user_insurances_patient_profile_id_unique ( patient_profile_id ) </title>
                    </use><a xlink:href='#medlink.user_insurances.patient_profile_id'><text
                            id='medlink&#46;user&#95;insurances&#46;patient&#95;profile&#95;id' x='858' y='1186'
                            onmouseover="hghl(['user_insurances_user_insurances_patient_profile_id_foreign','medlink.patient_profiles.id'])"
                            onmouseout="uhghl(['user_insurances_user_insurances_patient_profile_id_foreign','medlink.patient_profiles.id'])">patient&#95;profile&#95;id</text>
                        <title>&#10697; patient_profile_id
                            * bigint
                            &#8599; patient_profiles( id )</title>
                    </a>
                    <a xlink:href='#medlink.user_insurances.patient_profile_id'>
                        <use x='993' y='1173' xlink:href='#fk' />
                        <title>&#x1F517; References patient_profiles ( patient_profile_id -&gt; id ) </title>
                    </a>
                    <a xlink:href='#medlink.user_insurances.insurance_type'><text
                            id='medlink&#46;user&#95;insurances&#46;insurance&#95;type' x='858'
                            y='1205'>insurance&#95;type</text>
                        <title>&#10697; insurance_type
                            enum(&apos;public&apos;,&apos;private&apos;,&apos;vietnamese&apos;)</title>
                    </a>
                    <text x='1004' y='1201' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.user_insurances.insurance_number'><text
                            id='medlink&#46;user&#95;insurances&#46;insurance&#95;number' x='858'
                            y='1224'>insurance&#95;number</text>
                        <title>&#10697; insurance_number
                            varchar(255)</title>
                    </a>
                    <text x='1004' y='1220' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.user_insurances.registry'><text
                            id='medlink&#46;user&#95;insurances&#46;registry' x='858' y='1243'>registry</text>
                        <title>&#10697; registry
                            varchar(255)</title>
                    </a>
                    <text x='1004' y='1239' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.user_insurances.registered_address'><text
                            id='medlink&#46;user&#95;insurances&#46;registered&#95;address' x='858'
                            y='1262'>registered&#95;address</text>
                        <title>&#10697; registered_address
                            varchar(255)</title>
                    </a>
                    <text x='1004' y='1258' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.user_insurances.valid_from'><text
                            id='medlink&#46;user&#95;insurances&#46;valid&#95;from' x='858'
                            y='1281'>valid&#95;from</text>
                        <title>&#10697; valid_from
                            varchar(255)</title>
                    </a>
                    <text x='1004' y='1277' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.user_insurances.main_insured'><text
                            id='medlink&#46;user&#95;insurances&#46;main&#95;insured' x='858'
                            y='1300'>main&#95;insured</text>
                        <title>&#10697; main_insured
                            varchar(255)</title>
                    </a>
                    <text x='1004' y='1296' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.user_insurances.entitled_insured'><text
                            id='medlink&#46;user&#95;insurances&#46;entitled&#95;insured' x='858'
                            y='1319'>entitled&#95;insured</text>
                        <title>&#10697; entitled_insured
                            varchar(255)</title>
                    </a>
                    <text x='1004' y='1315' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.user_insurances.assurance_type'><text
                            id='medlink&#46;user&#95;insurances&#46;assurance&#95;type' x='858'
                            y='1338'>assurance&#95;type</text>
                        <title>&#10697; assurance_type
                            varchar(255)</title>
                    </a>
                    <text x='1004' y='1334' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.user_insurances.created_at'><text
                            id='medlink&#46;user&#95;insurances&#46;created&#95;at' x='858'
                            y='1357'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.user_insurances.updated_at'><text
                            id='medlink&#46;user&#95;insurances&#46;updated&#95;at' x='858'
                            y='1376'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'patient_profiles' == -->
                    <rect id='depict_medlink&#46;patient&#95;profiles' class='entity' style='stroke:#F9F9FC' x='1121'
                        y='1074' width='152' height='247' rx='4' ry='4' />
                    <rect x='1121' y='1074' width='152' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_4D66CC);' />
                    <rect x='1121' y='1078' width='152' height='29' style='stroke-width:0;fill:url(#tbg_4D66CC);' />
                    <a xlink:href='#medlink.patient_profiles'><text id='depict&#45;medlink&#46;patient&#95;profiles'
                            x='1148' y='1095' class='tableHeader' style='fill:#414248;'>patient&#95;profiles</text>
                        <title>Table medlink.patient_profiles</title>
                    </a>
                    <use x='1122' y='1117' xlink:href='#nn' />
                    <use x='1123' y='1116' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_patient_profiles ( id ) </title>
                    </use><a xlink:href='#medlink.patient_profiles.id'><text
                            id='medlink&#46;patient&#95;profiles&#46;id' x='1143' y='1129'
                            onmouseover="hghl(['appointments_appointments_patient_profile_id_foreign','medlink.appointments.patient_profile_id','reviews_reviews_patient_profile_id_foreign','medlink.reviews.patient_profile_id','user_insurances_user_insurances_patient_profile_id_foreign','medlink.user_insurances.patient_profile_id'])"
                            onmouseout="uhghl(['appointments_appointments_patient_profile_id_foreign','medlink.appointments.patient_profile_id','reviews_reviews_patient_profile_id_foreign','medlink.reviews.patient_profile_id','user_insurances_user_insurances_patient_profile_id_foreign','medlink.user_insurances.patient_profile_id'])"
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint
                            &#8601; appointments( patient_profile_id )
                            &#8601; reviews( patient_profile_id )
                            &#8601; user_insurances( patient_profile_id )</title>
                    </a>
                    <a xlink:href='#medlink.patient_profiles.id'>
                        <use x='1259' y='1116' xlink:href='#ref' />
                        <title>&#x1F517; Referred by appointments ( patient_profile_id -&gt; id )
                            Referred by reviews ( patient_profile_id -&gt; id )
                            Referred by user_insurances ( patient_profile_id -&gt; id ) </title>
                    </a>
                    <use x='1122' y='1136' xlink:href='#nn' />
                    <use x='1123' y='1135' xlink:href='#unq'>
                        <title>&#x1F50D; Unq patient_profiles_user_id_unique ( user_id ) </title>
                    </use><a xlink:href='#medlink.patient_profiles.user_id'><text
                            id='medlink&#46;patient&#95;profiles&#46;user&#95;id' x='1143' y='1148'
                            onmouseover="hghl(['patient_profiles_patient_profiles_user_id_foreign','medlink.users.id'])"
                            onmouseout="uhghl(['patient_profiles_patient_profiles_user_id_foreign','medlink.users.id'])">user&#95;id</text>
                        <title>&#10697; user_id
                            * bigint
                            &#8599; users( id )</title>
                    </a>
                    <a xlink:href='#medlink.patient_profiles.user_id'>
                        <use x='1259' y='1135' xlink:href='#fk' />
                        <title>&#x1F517; References users ( user_id -&gt; id ) </title>
                    </a>
                    <a xlink:href='#medlink.patient_profiles.birth_date'><text
                            id='medlink&#46;patient&#95;profiles&#46;birth&#95;date' x='1143'
                            y='1167'>birth&#95;date</text>
                        <title>&#10697; birth_date
                            varchar(255)</title>
                    </a>
                    <text x='1270' y='1163' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.patient_profiles.age'><text id='medlink&#46;patient&#95;profiles&#46;age'
                            x='1143' y='1186'>age</text>
                        <title>&#10697; age
                            int</title>
                    </a>
                    <text x='1270' y='1182' text-anchor='end' class='colType'>&#35;</text> <a
                        xlink:href='#medlink.patient_profiles.height'><text
                            id='medlink&#46;patient&#95;profiles&#46;height' x='1143' y='1205'>height</text>
                        <title>&#10697; height
                            int</title>
                    </a>
                    <text x='1270' y='1201' text-anchor='end' class='colType'>&#35;</text> <a
                        xlink:href='#medlink.patient_profiles.weight'><text
                            id='medlink&#46;patient&#95;profiles&#46;weight' x='1143' y='1224'>weight</text>
                        <title>&#10697; weight
                            int</title>
                    </a>
                    <text x='1270' y='1220' text-anchor='end' class='colType'>&#35;</text> <a
                        xlink:href='#medlink.patient_profiles.blood_group'><text
                            id='medlink&#46;patient&#95;profiles&#46;blood&#95;group' x='1143'
                            y='1243'>blood&#95;group</text>
                        <title>&#10697; blood_group
                            enum(&apos;a+&apos;,&apos;a-&apos;,&apos;b+&apos;,&apos;b-&apos;,&apos;o+&apos;,&apos;o-&apos;,&apos;ab+&apos;,&apos;ab-&apos;)
                        </title>
                    </a>
                    <text x='1270' y='1239' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.patient_profiles.medical_history'><text
                            id='medlink&#46;patient&#95;profiles&#46;medical&#95;history' x='1143'
                            y='1262'>medical&#95;history</text>
                        <title>&#10697; medical_history
                            text</title>
                    </a>
                    <text x='1270' y='1258' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.patient_profiles.created_at'><text
                            id='medlink&#46;patient&#95;profiles&#46;created&#95;at' x='1143'
                            y='1281'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.patient_profiles.updated_at'><text
                            id='medlink&#46;patient&#95;profiles&#46;updated&#95;at' x='1143'
                            y='1300'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'users' == -->
                    <rect id='depict_medlink&#46;users' class='entity' style='stroke:#FCFAF9' x='627' y='941'
                        width='152' height='494' rx='4' ry='4' />
                    <rect x='627' y='941' width='152' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_F7F2EC);' />
                    <rect x='627' y='945' width='152' height='29' style='stroke-width:0;fill:url(#tbg_F7F2EC);' />
                    <a xlink:href='#medlink.users'><text id='depict&#45;medlink&#46;users' x='684' y='962'
                            class='tableHeader' style='fill:#484441;'>users</text>
                        <title>Table medlink.users</title>
                    </a>
                    <use x='628' y='984' xlink:href='#nn' />
                    <use x='629' y='983' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_users ( id ) </title>
                    </use><a xlink:href='#medlink.users.id'><text id='medlink&#46;users&#46;id' x='649' y='996'
                            onmouseover="hghl(['doctor_profiles_doctor_profiles_user_id_foreign','medlink.doctor_profiles.user_id','favorites_favorites_doctor_id_foreign','medlink.favorites.doctor_id','favorites_favorites_patient_id_foreign','medlink.favorites.patient_id','notifications_notifications_user_id_foreign','medlink.notifications.user_id','patient_profiles_patient_profiles_user_id_foreign','medlink.patient_profiles.user_id','supports_supports_user_id_foreign','medlink.supports.user_id','transaction_histories_transaction_histories_user_id_foreign','medlink.transaction_histories.user_id','user_languages_user_languages_user_id_foreign','medlink.user_languages.user_id','user_settings_user_settings_user_id_foreign','medlink.user_settings.user_id'])"
                            onmouseout="uhghl(['doctor_profiles_doctor_profiles_user_id_foreign','medlink.doctor_profiles.user_id','favorites_favorites_doctor_id_foreign','medlink.favorites.doctor_id','favorites_favorites_patient_id_foreign','medlink.favorites.patient_id','notifications_notifications_user_id_foreign','medlink.notifications.user_id','patient_profiles_patient_profiles_user_id_foreign','medlink.patient_profiles.user_id','supports_supports_user_id_foreign','medlink.supports.user_id','transaction_histories_transaction_histories_user_id_foreign','medlink.transaction_histories.user_id','user_languages_user_languages_user_id_foreign','medlink.user_languages.user_id','user_settings_user_settings_user_id_foreign','medlink.user_settings.user_id'])"
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint
                            &#8601; doctor_profiles( user_id )
                            &#8601; favorites( doctor_id )
                            &#8601; favorites( patient_id )
                            &#8601; notifications( user_id )
                            &#8601; patient_profiles( user_id )
                            &#8601; supports( user_id )
                            &#8601; transaction_histories( user_id )
                            &#8601; user_languages( user_id )
                            &#8601; user_settings( user_id )</title>
                    </a>
                    <a xlink:href='#medlink.users.id'>
                        <use x='765' y='983' xlink:href='#ref' />
                        <title>&#x1F517; Referred by doctor_profiles ( user_id -&gt; id )
                            Referred by favorites ( doctor_id -&gt; id )
                            Referred by favorites ( patient_id -&gt; id )
                            Referred by notifications ( user_id -&gt; id )
                            Referred by patient_profiles ( user_id -&gt; id )
                            Referred by supports ( user_id -&gt; id )
                            Referred by transaction_histories ( user_id -&gt; id )
                            Referred by user_languages ( user_id -&gt; id )
                            Referred by user_settings ( user_id -&gt; id ) </title>
                    </a>
                    <use x='628' y='1003' xlink:href='#nn' /><a xlink:href='#medlink.users.user_type'><text
                            id='medlink&#46;users&#46;user&#95;type' x='649' y='1015'>user&#95;type</text>
                        <title>&#10697; user_type
                            * enum(&apos;healthcare&apos;,&apos;patient&apos;,&apos;admin&apos;) default
                            &apos;patient&apos;</title>
                    </a>
                    <text x='776' y='1011' text-anchor='end' class='colType'>t</text>
                    <use x='628' y='1022' xlink:href='#nn' /><a xlink:href='#medlink.users.identity'><text
                            id='medlink&#46;users&#46;identity' x='649' y='1034'>identity</text>
                        <title>&#10697; identity
                            *
                            enum(&apos;none&apos;,&apos;doctor&apos;,&apos;pharmacies&apos;,&apos;hospital&apos;,&apos;ambulance&apos;)
                            default &apos;none&apos;</title>
                    </a>
                    <text x='776' y='1030' text-anchor='end' class='colType'>t</text>
                    <use x='628' y='1041' xlink:href='#nn' />
                    <use x='629' y='1040' xlink:href='#unq'>
                        <title>&#x1F50D; Unq users_email_unique ( email ) </title>
                    </use><a xlink:href='#medlink.users.email'><text id='medlink&#46;users&#46;email' x='649'
                            y='1053'>email</text>
                        <title>&#10697; email
                            * varchar(255)</title>
                    </a>
                    <text x='776' y='1049' text-anchor='end' class='colType'>t</text>
                    <use x='628' y='1060' xlink:href='#nn' /><a xlink:href='#medlink.users.password'><text
                            id='medlink&#46;users&#46;password' x='649' y='1072'>password</text>
                        <title>&#10697; password
                            * varchar(255)</title>
                    </a>
                    <text x='776' y='1068' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.avatar'><text id='medlink&#46;users&#46;avatar' x='649'
                            y='1091'>avatar</text>
                        <title>&#10697; avatar
                            varchar(255)</title>
                    </a>
                    <text x='776' y='1087' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.name'><text id='medlink&#46;users&#46;name' x='649'
                            y='1110'>name</text>
                        <title>&#10697; name
                            varchar(255)</title>
                    </a>
                    <text x='776' y='1106' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.gender'><text id='medlink&#46;users&#46;gender' x='649'
                            y='1129'>gender</text>
                        <title>&#10697; gender
                            enum(&apos;male&apos;,&apos;female&apos;,&apos;other&apos;)</title>
                    </a>
                    <text x='776' y='1125' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.country_code'><text id='medlink&#46;users&#46;country&#95;code'
                            x='649' y='1148'>country&#95;code</text>
                        <title>&#10697; country_code
                            varchar(255)</title>
                    </a>
                    <text x='776' y='1144' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.phone'><text id='medlink&#46;users&#46;phone' x='649'
                            y='1167'>phone</text>
                        <title>&#10697; phone
                            varchar(255)</title>
                    </a>
                    <text x='776' y='1163' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.latitude'><text id='medlink&#46;users&#46;latitude' x='649'
                            y='1186'>latitude</text>
                        <title>&#10697; latitude
                            varchar(255)</title>
                    </a>
                    <text x='776' y='1182' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.longitude'><text id='medlink&#46;users&#46;longitude' x='649'
                            y='1205'>longitude</text>
                        <title>&#10697; longitude
                            varchar(255)</title>
                    </a>
                    <text x='776' y='1201' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.country'><text id='medlink&#46;users&#46;country' x='649'
                            y='1224'>country</text>
                        <title>&#10697; country
                            varchar(255)</title>
                    </a>
                    <text x='776' y='1220' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.city'><text id='medlink&#46;users&#46;city' x='649'
                            y='1243'>city</text>
                        <title>&#10697; city
                            varchar(255)</title>
                    </a>
                    <text x='776' y='1239' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.state'><text id='medlink&#46;users&#46;state' x='649'
                            y='1262'>state</text>
                        <title>&#10697; state
                            varchar(255)</title>
                    </a>
                    <text x='776' y='1258' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.address'><text id='medlink&#46;users&#46;address' x='649'
                            y='1281'>address</text>
                        <title>&#10697; address
                            varchar(255)</title>
                    </a>
                    <text x='776' y='1277' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.zip_code'><text id='medlink&#46;users&#46;zip&#95;code' x='649'
                            y='1300'>zip&#95;code</text>
                        <title>&#10697; zip_code
                            varchar(255)</title>
                    </a>
                    <text x='776' y='1296' text-anchor='end' class='colType'>t</text>
                    <use x='628' y='1307' xlink:href='#nn' /><a xlink:href='#medlink.users.status'><text
                            id='medlink&#46;users&#46;status' x='649' y='1319'>status</text>
                        <title>&#10697; status
                            * enum(&apos;suspend&apos;,&apos;waiting-approval&apos;,&apos;active&apos;) default
                            &apos;active&apos;</title>
                    </a>
                    <text x='776' y='1315' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.deleted_at'><text id='medlink&#46;users&#46;deleted&#95;at' x='649'
                            y='1338'>deleted&#95;at</text>
                        <title>&#10697; deleted_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.users.last_login'><text id='medlink&#46;users&#46;last&#95;login' x='649'
                            y='1357'>last&#95;login</text>
                        <title>&#10697; last_login
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.users.remember_token'><text id='medlink&#46;users&#46;remember&#95;token'
                            x='649' y='1376'>remember&#95;token</text>
                        <title>&#10697; remember_token
                            varchar(100)</title>
                    </a>
                    <text x='776' y='1372' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.users.created_at'><text id='medlink&#46;users&#46;created&#95;at' x='649'
                            y='1395'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.users.updated_at'><text id='medlink&#46;users&#46;updated&#95;at' x='649'
                            y='1414'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'notifications' == -->
                    <rect id='depict_medlink&#46;notifications' class='entity' style='stroke:#FCFAF9' x='627' y='1492'
                        width='152' height='190' rx='4' ry='4' />
                    <rect x='627' y='1492' width='152' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_FF9966);' />
                    <rect x='627' y='1496' width='152' height='29' style='stroke-width:0;fill:url(#tbg_FF9966);' />
                    <a xlink:href='#medlink.notifications'><text id='depict&#45;medlink&#46;notifications' x='663'
                            y='1513' class='tableHeader' style='fill:#484341;'>notifications</text>
                        <title>Table medlink.notifications</title>
                    </a>
                    <use x='628' y='1535' xlink:href='#nn' />
                    <use x='629' y='1534' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_notifications ( id ) </title>
                    </use><a xlink:href='#medlink.notifications.id'><text id='medlink&#46;notifications&#46;id' x='649'
                            y='1547' class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='776' y='1543' text-anchor='end' class='colType'>&#35;</text>
                    <use x='628' y='1554' xlink:href='#nn' /><a xlink:href='#medlink.notifications.title'><text
                            id='medlink&#46;notifications&#46;title' x='649' y='1566'>title</text>
                        <title>&#10697; title
                            * varchar(255)</title>
                    </a>
                    <text x='776' y='1562' text-anchor='end' class='colType'>t</text>
                    <use x='628' y='1573' xlink:href='#nn' />
                    <use x='629' y='1572' xlink:href='#idx'>
                        <title>&#x1F50D; notifications_user_id_foreign ( user_id ) </title>
                    </use><a xlink:href='#medlink.notifications.user_id'><text
                            id='medlink&#46;notifications&#46;user&#95;id' x='649' y='1585'
                            onmouseover="hghl(['notifications_notifications_user_id_foreign','medlink.users.id'])"
                            onmouseout="uhghl(['notifications_notifications_user_id_foreign','medlink.users.id'])">user&#95;id</text>
                        <title>&#10697; user_id
                            * bigint
                            &#8599; users( id )</title>
                    </a>
                    <a xlink:href='#medlink.notifications.user_id'>
                        <use x='765' y='1572' xlink:href='#fk' />
                        <title>&#x1F517; References users ( user_id -&gt; id ) </title>
                    </a>
                    <use x='629' y='1591' xlink:href='#idx'>
                        <title>&#x1F50D; notifications_appointment_id_foreign ( appointment_id ) </title>
                    </use><a xlink:href='#medlink.notifications.appointment_id'><text
                            id='medlink&#46;notifications&#46;appointment&#95;id' x='649' y='1604'
                            onmouseover="hghl(['notifications_notifications_appointment_id_foreign','medlink.appointments.id'])"
                            onmouseout="uhghl(['notifications_notifications_appointment_id_foreign','medlink.appointments.id'])">appointment&#95;id</text>
                        <title>&#10697; appointment_id
                            bigint
                            &#8599; appointments( id )</title>
                    </a>
                    <a xlink:href='#medlink.notifications.appointment_id'>
                        <use x='765' y='1591' xlink:href='#fk' />
                        <title>&#x1F517; References appointments ( appointment_id -&gt; id ) </title>
                    </a>
                    <use x='628' y='1611' xlink:href='#nn' /><a xlink:href='#medlink.notifications.status'><text
                            id='medlink&#46;notifications&#46;status' x='649' y='1623'>status</text>
                        <title>&#10697; status
                            * enum(&apos;unread&apos;,&apos;read&apos;) default &apos;unread&apos;</title>
                    </a>
                    <text x='776' y='1619' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.notifications.created_at'><text
                            id='medlink&#46;notifications&#46;created&#95;at' x='649' y='1642'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.notifications.updated_at'><text
                            id='medlink&#46;notifications&#46;updated&#95;at' x='649' y='1661'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'reviews' == -->
                    <rect id='depict_medlink&#46;reviews' class='entity' style='stroke:#FCFAF9' x='1577' y='998'
                        width='152' height='228' rx='4' ry='4' />
                    <rect x='1577' y='998' width='152' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_F4DDBE);' />
                    <rect x='1577' y='1002' width='152' height='29' style='stroke-width:0;fill:url(#tbg_F4DDBE);' />
                    <a xlink:href='#medlink.reviews'><text id='depict&#45;medlink&#46;reviews' x='1627' y='1019'
                            class='tableHeader' style='fill:#484441;'>reviews</text>
                        <title>Table medlink.reviews</title>
                    </a>
                    <use x='1578' y='1041' xlink:href='#nn' />
                    <use x='1579' y='1040' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_reviews ( id ) </title>
                    </use><a xlink:href='#medlink.reviews.id'><text id='medlink&#46;reviews&#46;id' x='1599' y='1053'
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='1726' y='1049' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1578' y='1060' xlink:href='#nn' />
                    <use x='1579' y='1059' xlink:href='#idx'>
                        <title>&#x1F50D; reviews_doctor_profile_id_foreign ( doctor_profile_id ) </title>
                    </use><a xlink:href='#medlink.reviews.doctor_profile_id'><text
                            id='medlink&#46;reviews&#46;doctor&#95;profile&#95;id' x='1599' y='1072'
                            onmouseover="hghl(['reviews_reviews_doctor_profile_id_foreign','medlink.doctor_profiles.id'])"
                            onmouseout="uhghl(['reviews_reviews_doctor_profile_id_foreign','medlink.doctor_profiles.id'])">doctor&#95;profile&#95;id</text>
                        <title>&#10697; doctor_profile_id
                            * bigint
                            &#8599; doctor_profiles( id )</title>
                    </a>
                    <a xlink:href='#medlink.reviews.doctor_profile_id'>
                        <use x='1715' y='1059' xlink:href='#fk' />
                        <title>&#x1F517; References doctor_profiles ( doctor_profile_id -&gt; id ) </title>
                    </a>
                    <use x='1578' y='1079' xlink:href='#nn' />
                    <use x='1579' y='1078' xlink:href='#idx'>
                        <title>&#x1F50D; reviews_patient_profile_id_foreign ( patient_profile_id ) </title>
                    </use><a xlink:href='#medlink.reviews.patient_profile_id'><text
                            id='medlink&#46;reviews&#46;patient&#95;profile&#95;id' x='1599' y='1091'
                            onmouseover="hghl(['reviews_reviews_patient_profile_id_foreign','medlink.patient_profiles.id'])"
                            onmouseout="uhghl(['reviews_reviews_patient_profile_id_foreign','medlink.patient_profiles.id'])">patient&#95;profile&#95;id</text>
                        <title>&#10697; patient_profile_id
                            * bigint
                            &#8599; patient_profiles( id )</title>
                    </a>
                    <a xlink:href='#medlink.reviews.patient_profile_id'>
                        <use x='1715' y='1078' xlink:href='#fk' />
                        <title>&#x1F517; References patient_profiles ( patient_profile_id -&gt; id ) </title>
                    </a>
                    <use x='1578' y='1098' xlink:href='#nn' />
                    <use x='1579' y='1097' xlink:href='#idx'>
                        <title>&#x1F50D; reviews_appointment_id_foreign ( appointment_id ) </title>
                    </use><a xlink:href='#medlink.reviews.appointment_id'><text
                            id='medlink&#46;reviews&#46;appointment&#95;id' x='1599' y='1110'
                            onmouseover="hghl(['reviews_reviews_appointment_id_foreign','medlink.appointments.id'])"
                            onmouseout="uhghl(['reviews_reviews_appointment_id_foreign','medlink.appointments.id'])">appointment&#95;id</text>
                        <title>&#10697; appointment_id
                            * bigint
                            &#8599; appointments( id )</title>
                    </a>
                    <a xlink:href='#medlink.reviews.appointment_id'>
                        <use x='1715' y='1097' xlink:href='#fk' />
                        <title>&#x1F517; References appointments ( appointment_id -&gt; id ) </title>
                    </a>
                    <use x='1578' y='1117' xlink:href='#nn' /><a xlink:href='#medlink.reviews.review'><text
                            id='medlink&#46;reviews&#46;review' x='1599' y='1129'>review</text>
                        <title>&#10697; review
                            * text</title>
                    </a>
                    <text x='1726' y='1125' text-anchor='end' class='colType'>t</text>
                    <use x='1578' y='1136' xlink:href='#nn' /><a xlink:href='#medlink.reviews.rate'><text
                            id='medlink&#46;reviews&#46;rate' x='1599' y='1148'>rate</text>
                        <title>&#10697; rate
                            * double</title>
                    </a>
                    <text x='1726' y='1144' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1578' y='1155' xlink:href='#nn' /><a xlink:href='#medlink.reviews.recommend'><text
                            id='medlink&#46;reviews&#46;recommend' x='1599' y='1167'>recommend</text>
                        <title>&#10697; recommend
                            * boolean</title>
                    </a>
                    <text x='1726' y='1163' text-anchor='end' class='colType'>b</text> <a
                        xlink:href='#medlink.reviews.created_at'><text id='medlink&#46;reviews&#46;created&#95;at'
                            x='1599' y='1186'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.reviews.updated_at'><text id='medlink&#46;reviews&#46;updated&#95;at'
                            x='1599' y='1205'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'bills' == -->
                    <rect id='depict_medlink&#46;bills' class='entity' style='stroke:#FCFAF9' x='1368' y='998'
                        width='152' height='209' rx='4' ry='4' />
                    <rect x='1368' y='998' width='152' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_FF9966);' />
                    <rect x='1368' y='1002' width='152' height='29' style='stroke-width:0;fill:url(#tbg_FF9966);' />
                    <a xlink:href='#medlink.bills'><text id='depict&#45;medlink&#46;bills' x='1429' y='1019'
                            class='tableHeader' style='fill:#484341;'>bills</text>
                        <title>Table medlink.bills</title>
                    </a>
                    <use x='1369' y='1041' xlink:href='#nn' />
                    <use x='1370' y='1040' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_bills ( id ) </title>
                    </use><a xlink:href='#medlink.bills.id'><text id='medlink&#46;bills&#46;id' x='1390' y='1053'
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * varchar(255)</title>
                    </a>
                    <text x='1517' y='1049' text-anchor='end' class='colType'>t</text>
                    <use x='1369' y='1060' xlink:href='#nn' />
                    <use x='1370' y='1059' xlink:href='#idx'>
                        <title>&#x1F50D; bills_appointment_id_foreign ( appointment_id ) </title>
                    </use><a xlink:href='#medlink.bills.appointment_id'><text
                            id='medlink&#46;bills&#46;appointment&#95;id' x='1390' y='1072'
                            onmouseover="hghl(['bills_bills_appointment_id_foreign','medlink.appointments.id'])"
                            onmouseout="uhghl(['bills_bills_appointment_id_foreign','medlink.appointments.id'])">appointment&#95;id</text>
                        <title>&#10697; appointment_id
                            * bigint
                            &#8599; appointments( id )</title>
                    </a>
                    <a xlink:href='#medlink.bills.appointment_id'>
                        <use x='1506' y='1059' xlink:href='#fk' />
                        <title>&#x1F517; References appointments ( appointment_id -&gt; id ) </title>
                    </a>
                    <use x='1369' y='1079' xlink:href='#nn' /><a xlink:href='#medlink.bills.payment_method'><text
                            id='medlink&#46;bills&#46;payment&#95;method' x='1390' y='1091'>payment&#95;method</text>
                        <title>&#10697; payment_method
                            * enum(&apos;wallet&apos;,&apos;credit_card&apos;,&apos;qr_transfer&apos;) default
                            &apos;wallet&apos;</title>
                    </a>
                    <text x='1517' y='1087' text-anchor='end' class='colType'>t</text>
                    <use x='1369' y='1098' xlink:href='#nn' /><a xlink:href='#medlink.bills.taxVAT'><text
                            id='medlink&#46;bills&#46;taxVAT' x='1390' y='1110'>taxVAT</text>
                        <title>&#10697; taxVAT
                            * double default &apos;0&apos;</title>
                    </a>
                    <text x='1517' y='1106' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1369' y='1117' xlink:href='#nn' /><a xlink:href='#medlink.bills.total'><text
                            id='medlink&#46;bills&#46;total' x='1390' y='1129'>total</text>
                        <title>&#10697; total
                            * double default &apos;0&apos;</title>
                    </a>
                    <text x='1517' y='1125' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1369' y='1136' xlink:href='#nn' /><a xlink:href='#medlink.bills.status'><text
                            id='medlink&#46;bills&#46;status' x='1390' y='1148'>status</text>
                        <title>&#10697; status
                            * enum(&apos;pending&apos;,&apos;paid&apos;,&apos;cancelled&apos;,&apos;refunded&apos;)
                            default &apos;pending&apos;</title>
                    </a>
                    <text x='1517' y='1144' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.bills.created_at'><text id='medlink&#46;bills&#46;created&#95;at' x='1390'
                            y='1167'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.bills.updated_at'><text id='medlink&#46;bills&#46;updated&#95;at' x='1390'
                            y='1186'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'doctor_profiles' == -->
                    <rect id='depict_medlink&#46;doctor&#95;profiles' class='entity' style='stroke:#F9FCF9' x='1311'
                        y='523' width='209' height='304' rx='4' ry='4' />
                    <rect x='1311' y='523' width='209' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_EEF7EC);' />
                    <rect x='1311' y='527' width='209' height='29' style='stroke-width:0;fill:url(#tbg_EEF7EC);' />
                    <a xlink:href='#medlink.doctor_profiles'><text id='depict&#45;medlink&#46;doctor&#95;profiles'
                            x='1368' y='544' class='tableHeader' style='fill:#424841;'>doctor&#95;profiles</text>
                        <title>Table medlink.doctor_profiles</title>
                    </a>
                    <use x='1312' y='566' xlink:href='#nn' />
                    <use x='1313' y='565' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_doctor_profiles ( id ) </title>
                    </use><a xlink:href='#medlink.doctor_profiles.id'><text id='medlink&#46;doctor&#95;profiles&#46;id'
                            x='1333' y='578'
                            onmouseover="hghl(['appointments_appointments_doctor_profile_id_foreign','medlink.appointments.doctor_profile_id','reviews_reviews_doctor_profile_id_foreign','medlink.reviews.doctor_profile_id','services_services_doctor_profile_id_foreign','medlink.services.doctor_profile_id','work_schedules_work_schedules_doctor_profile_id_foreign','medlink.work_schedules.doctor_profile_id'])"
                            onmouseout="uhghl(['appointments_appointments_doctor_profile_id_foreign','medlink.appointments.doctor_profile_id','reviews_reviews_doctor_profile_id_foreign','medlink.reviews.doctor_profile_id','services_services_doctor_profile_id_foreign','medlink.services.doctor_profile_id','work_schedules_work_schedules_doctor_profile_id_foreign','medlink.work_schedules.doctor_profile_id'])"
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint
                            &#8601; appointments( doctor_profile_id )
                            &#8601; reviews( doctor_profile_id )
                            &#8601; services( doctor_profile_id )
                            &#8601; work_schedules( doctor_profile_id )</title>
                    </a>
                    <a xlink:href='#medlink.doctor_profiles.id'>
                        <use x='1506' y='565' xlink:href='#ref' />
                        <title>&#x1F517; Referred by appointments ( doctor_profile_id -&gt; id )
                            Referred by reviews ( doctor_profile_id -&gt; id )
                            Referred by services ( doctor_profile_id -&gt; id )
                            Referred by work_schedules ( doctor_profile_id -&gt; id ) </title>
                    </a>
                    <use x='1312' y='585' xlink:href='#nn' />
                    <use x='1313' y='584' xlink:href='#unq'>
                        <title>&#x1F50D; Unq doctor_profiles_user_id_unique ( user_id ) </title>
                    </use><a xlink:href='#medlink.doctor_profiles.user_id'><text
                            id='medlink&#46;doctor&#95;profiles&#46;user&#95;id' x='1333' y='597'
                            onmouseover="hghl(['doctor_profiles_doctor_profiles_user_id_foreign','medlink.users.id'])"
                            onmouseout="uhghl(['doctor_profiles_doctor_profiles_user_id_foreign','medlink.users.id'])">user&#95;id</text>
                        <title>&#10697; user_id
                            * bigint
                            &#8599; users( id )</title>
                    </a>
                    <a xlink:href='#medlink.doctor_profiles.user_id'>
                        <use x='1506' y='584' xlink:href='#fk' />
                        <title>&#x1F517; References users ( user_id -&gt; id ) </title>
                    </a>
                    <a xlink:href='#medlink.doctor_profiles.id_card_path'><text
                            id='medlink&#46;doctor&#95;profiles&#46;id&#95;card&#95;path' x='1333'
                            y='616'>id&#95;card&#95;path</text>
                        <title>&#10697; id_card_path
                            varchar(255)</title>
                    </a>
                    <text x='1517' y='612' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.doctor_profiles.medical_degree_path'><text
                            id='medlink&#46;doctor&#95;profiles&#46;medical&#95;degree&#95;path' x='1333'
                            y='635'>medical&#95;degree&#95;path</text>
                        <title>&#10697; medical_degree_path
                            varchar(255)</title>
                    </a>
                    <text x='1517' y='631' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.doctor_profiles.professional_card_path'><text
                            id='medlink&#46;doctor&#95;profiles&#46;professional&#95;card&#95;path' x='1333'
                            y='654'>professional&#95;card&#95;path</text>
                        <title>&#10697; professional_card_path
                            varchar(255)</title>
                    </a>
                    <text x='1517' y='650' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.doctor_profiles.exploitation_license_path'><text
                            id='medlink&#46;doctor&#95;profiles&#46;exploitation&#95;license&#95;path' x='1333'
                            y='673'>exploitation&#95;license&#95;path</text>
                        <title>&#10697; exploitation_license_path
                            varchar(255)</title>
                    </a>
                    <text x='1517' y='669' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.doctor_profiles.professional_number'><text
                            id='medlink&#46;doctor&#95;profiles&#46;professional&#95;number' x='1333'
                            y='692'>professional&#95;number</text>
                        <title>&#10697; professional_number
                            varchar(255)</title>
                    </a>
                    <text x='1517' y='688' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.doctor_profiles.introduce'><text
                            id='medlink&#46;doctor&#95;profiles&#46;introduce' x='1333' y='711'>introduce</text>
                        <title>&#10697; introduce
                            text</title>
                    </a>
                    <text x='1517' y='707' text-anchor='end' class='colType'>t</text>
                    <use x='1313' y='717' xlink:href='#idx'>
                        <title>&#x1F50D; doctor_profiles_medical_category_id_foreign ( medical_category_id ) </title>
                    </use><a xlink:href='#medlink.doctor_profiles.medical_category_id'><text
                            id='medlink&#46;doctor&#95;profiles&#46;medical&#95;category&#95;id' x='1333' y='730'
                            onmouseover="hghl(['doctor_profiles_doctor_profiles_medical_category_id_foreign','medlink.medical_categories.id'])"
                            onmouseout="uhghl(['doctor_profiles_doctor_profiles_medical_category_id_foreign','medlink.medical_categories.id'])">medical&#95;category&#95;id</text>
                        <title>&#10697; medical_category_id
                            bigint
                            &#8599; medical_categories( id )</title>
                    </a>
                    <a xlink:href='#medlink.doctor_profiles.medical_category_id'>
                        <use x='1506' y='717' xlink:href='#fk' />
                        <title>&#x1F517; References medical_categories ( medical_category_id -&gt; id ) </title>
                    </a>
                    <a xlink:href='#medlink.doctor_profiles.office_address'><text
                            id='medlink&#46;doctor&#95;profiles&#46;office&#95;address' x='1333'
                            y='749'>office&#95;address</text>
                        <title>&#10697; office_address
                            varchar(255)</title>
                    </a>
                    <text x='1517' y='745' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.doctor_profiles.company_name'><text
                            id='medlink&#46;doctor&#95;profiles&#46;company&#95;name' x='1333'
                            y='768'>company&#95;name</text>
                        <title>&#10697; company_name
                            varchar(255)</title>
                    </a>
                    <text x='1517' y='764' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.doctor_profiles.created_at'><text
                            id='medlink&#46;doctor&#95;profiles&#46;created&#95;at' x='1333'
                            y='787'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.doctor_profiles.updated_at'><text
                            id='medlink&#46;doctor&#95;profiles&#46;updated&#95;at' x='1333'
                            y='806'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'services' == -->
                    <rect id='depict_medlink&#46;services' class='entity' style='stroke:#F9FCF9' x='1748' y='466'
                        width='152' height='285' rx='4' ry='4' />
                    <rect x='1748' y='466' width='152' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_EEF7EC);' />
                    <rect x='1748' y='470' width='152' height='29' style='stroke-width:0;fill:url(#tbg_EEF7EC);' />
                    <a xlink:href='#medlink.services'><text id='depict&#45;medlink&#46;services' x='1797' y='487'
                            class='tableHeader' style='fill:#424841;'>services</text>
                        <title>Table medlink.services</title>
                    </a>
                    <use x='1749' y='509' xlink:href='#nn' />
                    <use x='1750' y='508' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_services ( id ) </title>
                    </use><a xlink:href='#medlink.services.id'><text id='medlink&#46;services&#46;id' x='1770' y='521'
                            onmouseover="hghl(['appointments_appointments_service_id_foreign','medlink.appointments.service_id'])"
                            onmouseout="uhghl(['appointments_appointments_service_id_foreign','medlink.appointments.service_id'])"
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint
                            &#8601; appointments( service_id )</title>
                    </a>
                    <a xlink:href='#medlink.services.id'>
                        <use x='1886' y='508' xlink:href='#ref' />
                        <title>&#x1F517; Referred by appointments ( service_id -&gt; id ) </title>
                    </a>
                    <use x='1749' y='528' xlink:href='#nn' /><a xlink:href='#medlink.services.icon'><text
                            id='medlink&#46;services&#46;icon' x='1770' y='540'>icon</text>
                        <title>&#10697; icon
                            * varchar(255)</title>
                    </a>
                    <text x='1897' y='536' text-anchor='end' class='colType'>t</text>
                    <use x='1749' y='547' xlink:href='#nn' /><a xlink:href='#medlink.services.name'><text
                            id='medlink&#46;services&#46;name' x='1770' y='559'>name</text>
                        <title>&#10697; name
                            * varchar(255)</title>
                    </a>
                    <text x='1897' y='555' text-anchor='end' class='colType'>t</text>
                    <use x='1749' y='566' xlink:href='#nn' /><a xlink:href='#medlink.services.description'><text
                            id='medlink&#46;services&#46;description' x='1770' y='578'>description</text>
                        <title>&#10697; description
                            * text</title>
                    </a>
                    <text x='1897' y='574' text-anchor='end' class='colType'>t</text>
                    <use x='1749' y='585' xlink:href='#nn' /><a xlink:href='#medlink.services.price'><text
                            id='medlink&#46;services&#46;price' x='1770' y='597'>price</text>
                        <title>&#10697; price
                            * double</title>
                    </a>
                    <text x='1897' y='593' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1749' y='604' xlink:href='#nn' /><a xlink:href='#medlink.services.duration'><text
                            id='medlink&#46;services&#46;duration' x='1770' y='616'>duration</text>
                        <title>&#10697; duration
                            * int</title>
                    </a>
                    <text x='1897' y='612' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1749' y='623' xlink:href='#nn' /><a xlink:href='#medlink.services.buffer_time'><text
                            id='medlink&#46;services&#46;buffer&#95;time' x='1770' y='635'>buffer&#95;time</text>
                        <title>&#10697; buffer_time
                            * int</title>
                    </a>
                    <text x='1897' y='631' text-anchor='end' class='colType'>&#35;</text> <a
                        xlink:href='#medlink.services.seat'><text id='medlink&#46;services&#46;seat' x='1770'
                            y='654'>seat</text>
                        <title>&#10697; seat
                            varchar(255)</title>
                    </a>
                    <text x='1897' y='650' text-anchor='end' class='colType'>t</text>
                    <use x='1749' y='661' xlink:href='#nn' /><a xlink:href='#medlink.services.is_active'><text
                            id='medlink&#46;services&#46;is&#95;active' x='1770' y='673'>is&#95;active</text>
                        <title>&#10697; is_active
                            * boolean default &apos;1&apos;</title>
                    </a>
                    <text x='1897' y='669' text-anchor='end' class='colType'>b</text>
                    <use x='1749' y='680' xlink:href='#nn' />
                    <use x='1750' y='679' xlink:href='#idx'>
                        <title>&#x1F50D; services_doctor_profile_id_foreign ( doctor_profile_id ) </title>
                    </use><a xlink:href='#medlink.services.doctor_profile_id'><text
                            id='medlink&#46;services&#46;doctor&#95;profile&#95;id' x='1770' y='692'
                            onmouseover="hghl(['services_services_doctor_profile_id_foreign','medlink.doctor_profiles.id'])"
                            onmouseout="uhghl(['services_services_doctor_profile_id_foreign','medlink.doctor_profiles.id'])">doctor&#95;profile&#95;id</text>
                        <title>&#10697; doctor_profile_id
                            * bigint
                            &#8599; doctor_profiles( id )</title>
                    </a>
                    <a xlink:href='#medlink.services.doctor_profile_id'>
                        <use x='1886' y='679' xlink:href='#fk' />
                        <title>&#x1F517; References doctor_profiles ( doctor_profile_id -&gt; id ) </title>
                    </a>
                    <a xlink:href='#medlink.services.created_at'><text id='medlink&#46;services&#46;created&#95;at'
                            x='1770' y='711'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.services.updated_at'><text id='medlink&#46;services&#46;updated&#95;at'
                            x='1770' y='730'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'work_schedules' == -->
                    <rect id='depict_medlink&#46;work&#95;schedules' class='entity' style='stroke:#F9FCF9' x='1330'
                        y='162' width='152' height='209' rx='4' ry='4' />
                    <rect x='1330' y='162' width='152' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_EEF7EC);' />
                    <rect x='1330' y='166' width='152' height='29' style='stroke-width:0;fill:url(#tbg_EEF7EC);' />
                    <a xlink:href='#medlink.work_schedules'><text id='depict&#45;medlink&#46;work&#95;schedules'
                            x='1356' y='183' class='tableHeader' style='fill:#424841;'>work&#95;schedules</text>
                        <title>Table medlink.work_schedules</title>
                    </a>
                    <use x='1331' y='205' xlink:href='#nn' />
                    <use x='1332' y='204' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_work_schedules ( id ) </title>
                    </use><a xlink:href='#medlink.work_schedules.id'><text id='medlink&#46;work&#95;schedules&#46;id'
                            x='1352' y='217' class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint</title>
                    </a>
                    <text x='1479' y='213' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1331' y='224' xlink:href='#nn' />
                    <use x='1332' y='223' xlink:href='#idx'>
                        <title>&#x1F50D; work_schedules_doctor_profile_id_foreign ( doctor_profile_id ) </title>
                    </use><a xlink:href='#medlink.work_schedules.doctor_profile_id'><text
                            id='medlink&#46;work&#95;schedules&#46;doctor&#95;profile&#95;id' x='1352' y='236'
                            onmouseover="hghl(['work_schedules_work_schedules_doctor_profile_id_foreign','medlink.doctor_profiles.id'])"
                            onmouseout="uhghl(['work_schedules_work_schedules_doctor_profile_id_foreign','medlink.doctor_profiles.id'])">doctor&#95;profile&#95;id</text>
                        <title>&#10697; doctor_profile_id
                            * bigint
                            &#8599; doctor_profiles( id )</title>
                    </a>
                    <a xlink:href='#medlink.work_schedules.doctor_profile_id'>
                        <use x='1468' y='223' xlink:href='#fk' />
                        <title>&#x1F517; References doctor_profiles ( doctor_profile_id -&gt; id ) </title>
                    </a>
                    <use x='1331' y='243' xlink:href='#nn' /><a xlink:href='#medlink.work_schedules.day_of_week'><text
                            id='medlink&#46;work&#95;schedules&#46;day&#95;of&#95;week' x='1352'
                            y='255'>day&#95;of&#95;week</text>
                        <title>&#10697; day_of_week
                            *
                            enum(&apos;sunday&apos;,&apos;monday&apos;,&apos;tuesday&apos;,&apos;wednesday&apos;,&apos;thursday&apos;,&apos;friday&apos;,&apos;saturday&apos;)
                        </title>
                    </a>
                    <text x='1479' y='251' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.work_schedules.start_time'><text
                            id='medlink&#46;work&#95;schedules&#46;start&#95;time' x='1352'
                            y='274'>start&#95;time</text>
                        <title>&#10697; start_time
                            time</title>
                    </a>
                    <a xlink:href='#medlink.work_schedules.end_time'><text
                            id='medlink&#46;work&#95;schedules&#46;end&#95;time' x='1352' y='293'>end&#95;time</text>
                        <title>&#10697; end_time
                            time</title>
                    </a>
                    <use x='1331' y='300' xlink:href='#nn' /><a xlink:href='#medlink.work_schedules.all_day'><text
                            id='medlink&#46;work&#95;schedules&#46;all&#95;day' x='1352' y='312'>all&#95;day</text>
                        <title>&#10697; all_day
                            * boolean default &apos;0&apos;</title>
                    </a>
                    <text x='1479' y='308' text-anchor='end' class='colType'>b</text> <a
                        xlink:href='#medlink.work_schedules.created_at'><text
                            id='medlink&#46;work&#95;schedules&#46;created&#95;at' x='1352'
                            y='331'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.work_schedules.updated_at'><text
                            id='medlink&#46;work&#95;schedules&#46;updated&#95;at' x='1352'
                            y='350'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'medical_categories' == -->
                    <rect id='depict_medlink&#46;medical&#95;categories' class='entity' style='stroke:#F9FCF9' x='1558'
                        y='599' width='152' height='152' rx='4' ry='4' />
                    <rect x='1558' y='599' width='152' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_EEF7EC);' />
                    <rect x='1558' y='603' width='152' height='29' style='stroke-width:0;fill:url(#tbg_EEF7EC);' />
                    <a xlink:href='#medlink.medical_categories'><text id='depict&#45;medlink&#46;medical&#95;categories'
                            x='1574' y='620' class='tableHeader' style='fill:#424841;'>medical&#95;categories</text>
                        <title>Table medlink.medical_categories</title>
                    </a>
                    <use x='1559' y='642' xlink:href='#nn' />
                    <use x='1560' y='641' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_medical_categories ( id ) </title>
                    </use><a xlink:href='#medlink.medical_categories.id'><text
                            id='medlink&#46;medical&#95;categories&#46;id' x='1580' y='654'
                            onmouseover="hghl(['doctor_profiles_doctor_profiles_medical_category_id_foreign','medlink.doctor_profiles.medical_category_id'])"
                            onmouseout="uhghl(['doctor_profiles_doctor_profiles_medical_category_id_foreign','medlink.doctor_profiles.medical_category_id'])"
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint
                            &#8601; doctor_profiles( medical_category_id )</title>
                    </a>
                    <a xlink:href='#medlink.medical_categories.id'>
                        <use x='1696' y='641' xlink:href='#ref' />
                        <title>&#x1F517; Referred by doctor_profiles ( medical_category_id -&gt; id ) </title>
                    </a>
                    <use x='1559' y='661' xlink:href='#nn' /><a xlink:href='#medlink.medical_categories.name'><text
                            id='medlink&#46;medical&#95;categories&#46;name' x='1580' y='673'>name</text>
                        <title>&#10697; name
                            * varchar(255)</title>
                    </a>
                    <text x='1707' y='669' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.medical_categories.deleted_at'><text
                            id='medlink&#46;medical&#95;categories&#46;deleted&#95;at' x='1580'
                            y='692'>deleted&#95;at</text>
                        <title>&#10697; deleted_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.medical_categories.created_at'><text
                            id='medlink&#46;medical&#95;categories&#46;created&#95;at' x='1580'
                            y='711'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.medical_categories.updated_at'><text
                            id='medlink&#46;medical&#95;categories&#46;updated&#95;at' x='1580'
                            y='730'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                    <!-- == Table 'appointments' == -->
                    <rect id='depict_medlink&#46;appointments' class='entity' style='stroke:#FCFAF9' x='1843' y='1188'
                        width='171' height='380' rx='4' ry='4' />
                    <rect x='1843' y='1188' width='171' height='8' rx='4' ry='4'
                        style='stroke-width:0;fill:url(#ttl_FF9966);' />
                    <rect x='1843' y='1192' width='171' height='29' style='stroke-width:0;fill:url(#tbg_FF9966);' />
                    <a xlink:href='#medlink.appointments'><text id='depict&#45;medlink&#46;appointments' x='1884'
                            y='1209' class='tableHeader' style='fill:#484341;'>appointments</text>
                        <title>Table medlink.appointments</title>
                    </a>
                    <use x='1844' y='1231' xlink:href='#nn' />
                    <use x='1845' y='1230' xlink:href='#pk'>
                        <title>&#x1F511; Pk pk_appointments ( id ) </title>
                    </use><a xlink:href='#medlink.appointments.id'><text id='medlink&#46;appointments&#46;id' x='1865'
                            y='1243'
                            onmouseover="hghl(['bills_bills_appointment_id_foreign','medlink.bills.appointment_id','notifications_notifications_appointment_id_foreign','medlink.notifications.appointment_id','reviews_reviews_appointment_id_foreign','medlink.reviews.appointment_id'])"
                            onmouseout="uhghl(['bills_bills_appointment_id_foreign','medlink.bills.appointment_id','notifications_notifications_appointment_id_foreign','medlink.notifications.appointment_id','reviews_reviews_appointment_id_foreign','medlink.reviews.appointment_id'])"
                            class='colPk'>id</text>
                        <title>&#10697; id
                            * bigint
                            &#8601; bills( appointment_id )
                            &#8601; notifications( appointment_id )
                            &#8601; reviews( appointment_id )</title>
                    </a>
                    <a xlink:href='#medlink.appointments.id'>
                        <use x='2000' y='1230' xlink:href='#ref' />
                        <title>&#x1F517; Referred by bills ( appointment_id -&gt; id )
                            Referred by notifications ( appointment_id -&gt; id )
                            Referred by reviews ( appointment_id -&gt; id ) </title>
                    </a>
                    <use x='1844' y='1250' xlink:href='#nn' />
                    <use x='1845' y='1249' xlink:href='#idx'>
                        <title>&#x1F50D; appointments_patient_profile_id_foreign ( patient_profile_id ) </title>
                    </use><a xlink:href='#medlink.appointments.patient_profile_id'><text
                            id='medlink&#46;appointments&#46;patient&#95;profile&#95;id' x='1865' y='1262'
                            onmouseover="hghl(['appointments_appointments_patient_profile_id_foreign','medlink.patient_profiles.id'])"
                            onmouseout="uhghl(['appointments_appointments_patient_profile_id_foreign','medlink.patient_profiles.id'])">patient&#95;profile&#95;id</text>
                        <title>&#10697; patient_profile_id
                            * bigint
                            &#8599; patient_profiles( id )</title>
                    </a>
                    <a xlink:href='#medlink.appointments.patient_profile_id'>
                        <use x='2000' y='1249' xlink:href='#fk' />
                        <title>&#x1F517; References patient_profiles ( patient_profile_id -&gt; id ) </title>
                    </a>
                    <use x='1844' y='1269' xlink:href='#nn' />
                    <use x='1845' y='1268' xlink:href='#idx'>
                        <title>&#x1F50D; appointments_doctor_profile_id_foreign ( doctor_profile_id ) </title>
                    </use><a xlink:href='#medlink.appointments.doctor_profile_id'><text
                            id='medlink&#46;appointments&#46;doctor&#95;profile&#95;id' x='1865' y='1281'
                            onmouseover="hghl(['appointments_appointments_doctor_profile_id_foreign','medlink.doctor_profiles.id'])"
                            onmouseout="uhghl(['appointments_appointments_doctor_profile_id_foreign','medlink.doctor_profiles.id'])">doctor&#95;profile&#95;id</text>
                        <title>&#10697; doctor_profile_id
                            * bigint
                            &#8599; doctor_profiles( id )</title>
                    </a>
                    <a xlink:href='#medlink.appointments.doctor_profile_id'>
                        <use x='2000' y='1268' xlink:href='#fk' />
                        <title>&#x1F517; References doctor_profiles ( doctor_profile_id -&gt; id ) </title>
                    </a>
                    <use x='1844' y='1288' xlink:href='#nn' />
                    <use x='1845' y='1287' xlink:href='#idx'>
                        <title>&#x1F50D; appointments_service_id_foreign ( service_id ) </title>
                    </use><a xlink:href='#medlink.appointments.service_id'><text
                            id='medlink&#46;appointments&#46;service&#95;id' x='1865' y='1300'
                            onmouseover="hghl(['appointments_appointments_service_id_foreign','medlink.services.id'])"
                            onmouseout="uhghl(['appointments_appointments_service_id_foreign','medlink.services.id'])">service&#95;id</text>
                        <title>&#10697; service_id
                            * bigint
                            &#8599; services( id )</title>
                    </a>
                    <a xlink:href='#medlink.appointments.service_id'>
                        <use x='2000' y='1287' xlink:href='#fk' />
                        <title>&#x1F517; References services ( service_id -&gt; id ) </title>
                    </a>
                    <use x='1844' y='1307' xlink:href='#nn' /><a xlink:href='#medlink.appointments.status'><text
                            id='medlink&#46;appointments&#46;status' x='1865' y='1319'>status</text>
                        <title>&#10697; status
                            *
                            enum(&apos;cancelled&apos;,&apos;rejected&apos;,&apos;pending&apos;,&apos;upcoming&apos;,&apos;completed&apos;)
                            default &apos;pending&apos;</title>
                    </a>
                    <text x='2011' y='1315' text-anchor='end' class='colType'>t</text>
                    <use x='1844' y='1326' xlink:href='#nn' /><a
                        xlink:href='#medlink.appointments.medical_problem'><text
                            id='medlink&#46;appointments&#46;medical&#95;problem' x='1865'
                            y='1338'>medical&#95;problem</text>
                        <title>&#10697; medical_problem
                            * text</title>
                    </a>
                    <text x='2011' y='1334' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.appointments.medical_problem_file'><text
                            id='medlink&#46;appointments&#46;medical&#95;problem&#95;file' x='1865'
                            y='1357'>medical&#95;problem&#95;file</text>
                        <title>&#10697; medical_problem_file
                            varchar(255)</title>
                    </a>
                    <text x='2011' y='1353' text-anchor='end' class='colType'>t</text>
                    <use x='1844' y='1364' xlink:href='#nn' /><a xlink:href='#medlink.appointments.duration'><text
                            id='medlink&#46;appointments&#46;duration' x='1865' y='1376'>duration</text>
                        <title>&#10697; duration
                            * int</title>
                    </a>
                    <text x='2011' y='1372' text-anchor='end' class='colType'>&#35;</text>
                    <use x='1844' y='1383' xlink:href='#nn' /><a xlink:href='#medlink.appointments.date'><text
                            id='medlink&#46;appointments&#46;date' x='1865' y='1395'>date</text>
                        <title>&#10697; date
                            * date</title>
                    </a>
                    <text x='2011' y='1391' text-anchor='end' class='colType'>d</text>
                    <use x='1844' y='1402' xlink:href='#nn' /><a xlink:href='#medlink.appointments.day_of_week'><text
                            id='medlink&#46;appointments&#46;day&#95;of&#95;week' x='1865'
                            y='1414'>day&#95;of&#95;week</text>
                        <title>&#10697; day_of_week
                            * varchar(255)</title>
                    </a>
                    <text x='2011' y='1410' text-anchor='end' class='colType'>t</text>
                    <use x='1844' y='1421' xlink:href='#nn' /><a xlink:href='#medlink.appointments.time'><text
                            id='medlink&#46;appointments&#46;time' x='1865' y='1433'>time</text>
                        <title>&#10697; time
                            * varchar(255)</title>
                    </a>
                    <text x='2011' y='1429' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.appointments.reason'><text id='medlink&#46;appointments&#46;reason'
                            x='1865' y='1452'>reason</text>
                        <title>&#10697; reason
                            varchar(255)</title>
                    </a>
                    <text x='2011' y='1448' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.appointments.link'><text id='medlink&#46;appointments&#46;link' x='1865'
                            y='1471'>link</text>
                        <title>&#10697; link
                            varchar(255)</title>
                    </a>
                    <text x='2011' y='1467' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.appointments.address'><text id='medlink&#46;appointments&#46;address'
                            x='1865' y='1490'>address</text>
                        <title>&#10697; address
                            varchar(255)</title>
                    </a>
                    <text x='2011' y='1486' text-anchor='end' class='colType'>t</text> <a
                        xlink:href='#medlink.appointments.deleted_at'><text
                            id='medlink&#46;appointments&#46;deleted&#95;at' x='1865' y='1509'>deleted&#95;at</text>
                        <title>&#10697; deleted_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.appointments.created_at'><text
                            id='medlink&#46;appointments&#46;created&#95;at' x='1865' y='1528'>created&#95;at</text>
                        <title>&#10697; created_at
                            timestamp</title>
                    </a>
                    <a xlink:href='#medlink.appointments.updated_at'><text
                            id='medlink&#46;appointments&#46;updated&#95;at' x='1865' y='1547'>updated&#95;at</text>
                        <title>&#10697; updated_at
                            timestamp</title>
                    </a>

                </g>
            </svg>
        </div>
        <script type='text/javascript'>
            var svgContainers = document.getElementsByClassName("svgContainer");
            for (let i = 0; i < svgContainers.length; i++) {
                installListeners(svgContainers[i], svgContainers[i].getElementsByTagName('svg')[0]);
            }

            document.addEventListener('keydown', function (event) {
                if (event.ctrlKey && event.key === '0') {
                    var svgContainers = document.getElementsByClassName("svgContainer");
                    for (let i = 0; i < svgContainers.length; i++) {
                        var svgImage = svgContainers[i].getElementsByTagName('svg')[0]
                        viewBox = { x: 0, y: 0, w: svgImage.clientWidth, h: svgImage.clientHeight };
                        svgImage.setAttribute('viewBox', `${viewBox.x} ${viewBox.y} ${viewBox.w} ${viewBox.h}`);
                    }
                }
            });

            function installListeners(svgContainer, svgImage) {

                var viewBox = { x: 0, y: 0, w: svgImage.clientWidth, h: svgImage.clientHeight };
                svgImage.setAttribute('viewBox', `${viewBox.x} ${viewBox.y} ${viewBox.w} ${viewBox.h}`);
                const svgSize = { w: svgImage.clientWidth, h: svgImage.clientHeight };
                var isPanning = false;
                var startPoint = { x: 0, y: 0 };
                var endPoint = { x: 0, y: 0 };;
                var scale = 1;

                svgContainer.onmousewheel = function (e) {
                    if (e.ctrlKey == true) {
                        e.preventDefault();
                        var w = viewBox.w;
                        var h = viewBox.h;
                        var mx = e.offsetX;//mouse x
                        var my = e.offsetY;
                        var dw = w * Math.sign(e.deltaY) * 0.05;
                        var dh = h * Math.sign(e.deltaY) * 0.05;
                        var dx = dw * mx / svgSize.w;
                        var dy = dh * my / svgSize.h;
                        viewBox = { x: viewBox.x + dx, y: viewBox.y + dy, w: viewBox.w - dw, h: viewBox.h - dh };
                        scale = svgSize.w / viewBox.w;
                        svgImage.setAttribute('viewBox', `${viewBox.x} ${viewBox.y} ${viewBox.w} ${viewBox.h}`);
                    }
                }


                svgContainer.onmousedown = function (e) {
                    isPanning = true;
                    startPoint = { x: e.x, y: e.y };
                }

                svgContainer.onmousemove = function (e) {
                    if (isPanning) {
                        endPoint = { x: e.x, y: e.y };
                        var dx = (startPoint.x - endPoint.x) / scale;
                        var dy = (startPoint.y - endPoint.y) / scale;
                        var movedViewBox = { x: viewBox.x + dx, y: viewBox.y + dy, w: viewBox.w, h: viewBox.h };
                        svgImage.setAttribute('viewBox', `${movedViewBox.x} ${movedViewBox.y} ${movedViewBox.w} ${movedViewBox.h}`);
                    }
                }

                svgContainer.onmouseup = function (e) {
                    if (isPanning) {
                        endPoint = { x: e.x, y: e.y };
                        var dx = (startPoint.x - endPoint.x) / scale;
                        var dy = (startPoint.y - endPoint.y) / scale;
                        viewBox = { x: viewBox.x + dx, y: viewBox.y + dy, w: viewBox.w, h: viewBox.h };
                        svgImage.setAttribute('viewBox', `${viewBox.x} ${viewBox.y} ${viewBox.w} ${viewBox.h}`);
                        isPanning = false;
                    }
                }

                svgContainer.onmouseleave = function (e) {
                    isPanning = false;
                }
            }

            function searchSVG(searchValue) {
                const svgElements = document.querySelectorAll('svg text'); //[id]

                // Reset previous highlights
                svgElements.forEach(element => {
                    element.classList.remove('search');
                });

                svgElements.forEach(element => {
                    if (searchValue.trim() !== "" && element.id.toLowerCase().includes(searchValue)) {
                        element.classList.add('search');
                    }
                });
            }
        </script>
    </div>
    <div class='container pt-2'>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink' style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Schema medlink</h5>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.app_settings'
                    onclick="window.scrollTo(60, 608);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.app_settings').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table app_settings</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.app_settings.id'>id</a></td>
                            <td class='dataType'> CHAR&#40;36&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.app_settings.tab'>tab</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.app_settings.key'>key</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.app_settings.default'>default</a></td>
                            <td class='dataType'> LONGTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.app_settings.value'>value</a></td>
                            <td class='dataType'> LONGTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.app_settings.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.app_settings.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;app&#95;settings</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.appointments'
                    onclick="window.scrollTo(1643, 1197);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.appointments').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table appointments</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td><a name='medlink.appointments.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.appointments.patient_profile_id'>patient&#95;profile&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.appointments.doctor_profile_id'>doctor&#95;profile&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.appointments.service_id'>service&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.appointments.status'>status</a></td>
                            <td class='dataType'>
                                ENUM&#40;&#39;cancelled&#39;&#44;&#39;rejected&#39;&#44;&#39;pending&#39;&#44;&#39;upcoming&#39;&#44;&#39;completed&#39;&#41;
                                COLLATE utf8mb4&#95;unicode&#95;ci DEFAULT 'pending' </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.appointments.medical_problem'>medical&#95;problem</a></td>
                            <td class='dataType'> TEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.appointments.medical_problem_file'>medical&#95;problem&#95;file</a>
                            </td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.appointments.duration'>duration</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.appointments.date'>date</a></td>
                            <td class='dataType'> DATE </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.appointments.day_of_week'>day&#95;of&#95;week</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.appointments.time'>time</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.appointments.reason'>reason</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.appointments.link'>link</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.appointments.address'>address</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.appointments.deleted_at'>deleted&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.appointments.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.appointments.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;appointments</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>appointments&#95;patient&#95;profile&#95;id&#95;foreign</td>
                            <td>Index ON patient&#95;profile&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>appointments&#95;doctor&#95;profile&#95;id&#95;foreign</td>
                            <td>Index ON doctor&#95;profile&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>appointments&#95;service&#95;id&#95;foreign</td>
                            <td>Index ON service&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>appointments_doctor_profile_id_foreign</td>
                            <td> doctor&#95;profile&#95;id &#8599; <a href='#medlink&#46;doctor&#95;profiles'
                                    onclick="window.scrollTo(1111, 532);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.doctor_profiles').classList.add('palpable'); return false;">&#10063;
                                    doctor&#95;profiles</a>(id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>appointments_patient_profile_id_foreign</td>
                            <td> patient&#95;profile&#95;id &#8599; <a href='#medlink&#46;patient&#95;profiles'
                                    onclick="window.scrollTo(921, 1083);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.patient_profiles').classList.add('palpable'); return false;">&#10063;
                                    patient&#95;profiles</a>(id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>appointments_service_id_foreign</td>
                            <td> service&#95;id &#8599; <a href='#medlink&#46;services'
                                    onclick="window.scrollTo(1548, 475);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.services').classList.add('palpable'); return false;">&#10063;
                                    services</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Referring Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>bills_appointment_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;bills'
                                    onclick="window.scrollTo(1168, 1007);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.bills').classList.add('palpable'); return false;">&#10063;
                                    bills</a>(appointment&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>notifications_appointment_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;notifications'
                                    onclick="window.scrollTo(427, 1501);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.notifications').classList.add('palpable'); return false;">&#10063;
                                    notifications</a>(appointment&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>reviews_appointment_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;reviews'
                                    onclick="window.scrollTo(1377, 1007);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.reviews').classList.add('palpable'); return false;">&#10063;
                                    reviews</a>(appointment&#95;id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;11 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.bills'
                    onclick="window.scrollTo(1168, 1007);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.bills').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table bills</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.bills.id'>id</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.bills.appointment_id'>appointment&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.bills.payment_method'>payment&#95;method</a></td>
                            <td class='dataType'>
                                ENUM&#40;&#39;wallet&#39;&#44;&#39;credit&#95;card&#39;&#44;&#39;qr&#95;transfer&#39;&#41;
                                COLLATE utf8mb4&#95;unicode&#95;ci DEFAULT 'wallet' </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.bills.taxVAT'>taxVAT</a></td>
                            <td class='dataType'> DOUBLE DEFAULT '0' </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.bills.total'>total</a></td>
                            <td class='dataType'> DOUBLE DEFAULT '0' </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.bills.status'>status</a></td>
                            <td class='dataType'>
                                ENUM&#40;&#39;pending&#39;&#44;&#39;paid&#39;&#44;&#39;cancelled&#39;&#44;&#39;refunded&#39;&#41;
                                COLLATE utf8mb4&#95;unicode&#95;ci DEFAULT 'pending' </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.bills.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.bills.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;bills</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>bills&#95;appointment&#95;id&#95;foreign</td>
                            <td>Index ON appointment&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>bills_appointment_id_foreign</td>
                            <td> appointment&#95;id &#8599; <a href='#medlink&#46;appointments'
                                    onclick="window.scrollTo(1643, 1197);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.appointments').classList.add('palpable'); return false;">&#10063;
                                    appointments</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.cache'
                    onclick="window.scrollTo(161, 399);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.cache').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table cache</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.cache.key'>key</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.cache.value'>value</a></td>
                            <td class='dataType'> MEDIUMTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.cache.expiration'>expiration</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;cache</td>
                            <td>Primary Key ON key</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.cache_locks'
                    onclick="window.scrollTo(294, 399);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.cache_locks').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table cache_locks</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.cache_locks.key'>key</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.cache_locks.owner'>owner</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.cache_locks.expiration'>expiration</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;cache&#95;locks</td>
                            <td>Primary Key ON key</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.doctor_profiles'
                    onclick="window.scrollTo(1111, 532);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.doctor_profiles').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table doctor_profiles</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td><a name='medlink.doctor_profiles.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.doctor_profiles.user_id'>user&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.doctor_profiles.id_card_path'>id&#95;card&#95;path</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.doctor_profiles.medical_degree_path'>medical&#95;degree&#95;path</a>
                            </td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a
                                    name='medlink.doctor_profiles.professional_card_path'>professional&#95;card&#95;path</a>
                            </td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a
                                    name='medlink.doctor_profiles.exploitation_license_path'>exploitation&#95;license&#95;path</a>
                            </td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.doctor_profiles.professional_number'>professional&#95;number</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.doctor_profiles.introduce'>introduce</a></td>
                            <td class='dataType'> TEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.doctor_profiles.medical_category_id'>medical&#95;category&#95;id</a>
                            </td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.doctor_profiles.office_address'>office&#95;address</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.doctor_profiles.company_name'>company&#95;name</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.doctor_profiles.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.doctor_profiles.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;doctor&#95;profiles</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>doctor&#95;profiles&#95;user&#95;id&#95;unique</td>
                            <td>Unique Key ON user&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>doctor&#95;profiles&#95;medical&#95;category&#95;id&#95;foreign</td>
                            <td>Index ON medical&#95;category&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>doctor_profiles_medical_category_id_foreign</td>
                            <td> medical&#95;category&#95;id &#8599; <a href='#medlink&#46;medical&#95;categories'
                                    onclick="window.scrollTo(1358, 608);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.medical_categories').classList.add('palpable'); return false;">&#10063;
                                    medical&#95;categories</a>(id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>doctor_profiles_user_id_foreign</td>
                            <td> user&#95;id &#8599; <a href='#medlink&#46;users'
                                    onclick="window.scrollTo(427, 950);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.users').classList.add('palpable'); return false;">&#10063;
                                    users</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Referring Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>appointments_doctor_profile_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;appointments'
                                    onclick="window.scrollTo(1643, 1197);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.appointments').classList.add('palpable'); return false;">&#10063;
                                    appointments</a>(doctor&#95;profile&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>reviews_doctor_profile_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;reviews'
                                    onclick="window.scrollTo(1377, 1007);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.reviews').classList.add('palpable'); return false;">&#10063;
                                    reviews</a>(doctor&#95;profile&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>services_doctor_profile_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;services'
                                    onclick="window.scrollTo(1548, 475);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.services').classList.add('palpable'); return false;">&#10063;
                                    services</a>(doctor&#95;profile&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>work_schedules_doctor_profile_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;work&#95;schedules'
                                    onclick="window.scrollTo(1130, 171);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.work_schedules').classList.add('palpable'); return false;">&#10063;
                                    work&#95;schedules</a>(doctor&#95;profile&#95;id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;20 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.failed_jobs'
                    onclick="window.scrollTo(180, 114);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.failed_jobs').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table failed_jobs</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.failed_jobs.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.failed_jobs.uuid'>uuid</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.failed_jobs.connection'>connection</a></td>
                            <td class='dataType'> TEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.failed_jobs.queue'>queue</a></td>
                            <td class='dataType'> TEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.failed_jobs.payload'>payload</a></td>
                            <td class='dataType'> LONGTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.failed_jobs.exception'>exception</a></td>
                            <td class='dataType'> LONGTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.failed_jobs.failed_at'>failed&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP DEFAULT CURRENT_TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;failed&#95;jobs</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>failed&#95;jobs&#95;uuid&#95;unique</td>
                            <td>Unique Key ON uuid</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.favorites'
                    onclick="window.scrollTo(161, 1368);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.favorites').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table favorites</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.favorites.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.favorites.type'>type</a></td>
                            <td class='dataType'> ENUM&#40;&#39;doctor&#39;&#44;&#39;patient&#39;&#41; COLLATE
                                utf8mb4&#95;unicode&#95;ci DEFAULT 'doctor' </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.favorites.patient_id'>patient&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.favorites.doctor_id'>doctor&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.favorites.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.favorites.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;favorites</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>favorites&#95;patient&#95;id&#95;foreign</td>
                            <td>Index ON patient&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>favorites&#95;doctor&#95;id&#95;foreign</td>
                            <td>Index ON doctor&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>favorites_doctor_id_foreign</td>
                            <td> doctor&#95;id &#8599; <a href='#medlink&#46;users'
                                    onclick="window.scrollTo(427, 950);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.users').classList.add('palpable'); return false;">&#10063;
                                    users</a>(id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>favorites_patient_id_foreign</td>
                            <td> patient&#95;id &#8599; <a href='#medlink&#46;users'
                                    onclick="window.scrollTo(427, 950);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.users').classList.add('palpable'); return false;">&#10063;
                                    users</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.job_batches'
                    onclick="window.scrollTo(60, 95);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.job_batches').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table job_batches</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.job_batches.id'>id</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.job_batches.name'>name</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.job_batches.total_jobs'>total&#95;jobs</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.job_batches.pending_jobs'>pending&#95;jobs</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.job_batches.failed_jobs'>failed&#95;jobs</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.job_batches.failed_job_ids'>failed&#95;job&#95;ids</a></td>
                            <td class='dataType'> LONGTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.job_batches.options'>options</a></td>
                            <td class='dataType'> MEDIUMTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.job_batches.cancelled_at'>cancelled&#95;at</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.job_batches.created_at'>created&#95;at</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.job_batches.finished_at'>finished&#95;at</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;job&#95;batches</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.jobs'
                    onclick="window.scrollTo(60, 114);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.jobs').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table jobs</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.jobs.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.jobs.queue'>queue</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.jobs.payload'>payload</a></td>
                            <td class='dataType'> LONGTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.jobs.attempts'>attempts</a></td>
                            <td class='dataType'> TINYINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.jobs.reserved_at'>reserved&#95;at</a></td>
                            <td class='dataType'> INT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.jobs.available_at'>available&#95;at</a></td>
                            <td class='dataType'> INT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.jobs.created_at'>created&#95;at</a></td>
                            <td class='dataType'> INT UNSIGNED </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;jobs</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>jobs&#95;queue&#95;index</td>
                            <td>Index ON queue</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.languages'
                    onclick="window.scrollTo(60, 931);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.languages').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table languages</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td><a name='medlink.languages.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.languages.name'>name</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.languages.code'>code</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.languages.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.languages.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;languages</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>languages&#95;name&#95;unique</td>
                            <td>Unique Key ON name</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>languages&#95;code&#95;unique</td>
                            <td>Unique Key ON code</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Referring Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>user_languages_language_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;user&#95;languages'
                                    onclick="window.scrollTo(180, 931);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.user_languages').classList.add('palpable'); return false;">&#10063;
                                    user&#95;languages</a>(language&#95;id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;3 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.medical_categories'
                    onclick="window.scrollTo(1358, 608);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.medical_categories').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table medical_categories</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td><a name='medlink.medical_categories.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.medical_categories.name'>name</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.medical_categories.deleted_at'>deleted&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.medical_categories.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.medical_categories.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;medical&#95;categories</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Referring Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>doctor_profiles_medical_category_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;doctor&#95;profiles'
                                    onclick="window.scrollTo(1111, 532);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.doctor_profiles').classList.add('palpable'); return false;">&#10063;
                                    doctor&#95;profiles</a>(medical&#95;category&#95;id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;22 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.migrations'
                    onclick="window.scrollTo(60, 399);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.migrations').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table migrations</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.migrations.id'>id</a></td>
                            <td class='dataType'> INT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.migrations.migration'>migration</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.migrations.batch'>batch</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;migrations</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;30 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.notifications'
                    onclick="window.scrollTo(427, 1501);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.notifications').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table notifications</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.notifications.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.notifications.title'>title</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.notifications.user_id'>user&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.notifications.appointment_id'>appointment&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.notifications.status'>status</a></td>
                            <td class='dataType'> ENUM&#40;&#39;unread&#39;&#44;&#39;read&#39;&#41; COLLATE
                                utf8mb4&#95;unicode&#95;ci DEFAULT 'unread' </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.notifications.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.notifications.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;notifications</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>notifications&#95;user&#95;id&#95;foreign</td>
                            <td>Index ON user&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>notifications&#95;appointment&#95;id&#95;foreign</td>
                            <td>Index ON appointment&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>notifications_appointment_id_foreign</td>
                            <td> appointment&#95;id &#8599; <a href='#medlink&#46;appointments'
                                    onclick="window.scrollTo(1643, 1197);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.appointments').classList.add('palpable'); return false;">&#10063;
                                    appointments</a>(id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>notifications_user_id_foreign</td>
                            <td> user&#95;id &#8599; <a href='#medlink&#46;users'
                                    onclick="window.scrollTo(427, 950);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.users').classList.add('palpable'); return false;">&#10063;
                                    users</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;161 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.patient_profiles'
                    onclick="window.scrollTo(921, 1083);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.patient_profiles').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table patient_profiles</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td><a name='medlink.patient_profiles.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.patient_profiles.user_id'>user&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.patient_profiles.birth_date'>birth&#95;date</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.patient_profiles.age'>age</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.patient_profiles.height'>height</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.patient_profiles.weight'>weight</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.patient_profiles.blood_group'>blood&#95;group</a></td>
                            <td class='dataType'>
                                ENUM&#40;&#39;A&#43;&#39;&#44;&#39;A&#45;&#39;&#44;&#39;B&#43;&#39;&#44;&#39;B&#45;&#39;&#44;&#39;O&#43;&#39;&#44;&#39;O&#45;&#39;&#44;&#39;AB&#43;&#39;&#44;&#39;AB&#45;&#39;&#41;
                                COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.patient_profiles.medical_history'>medical&#95;history</a></td>
                            <td class='dataType'> TEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.patient_profiles.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.patient_profiles.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;patient&#95;profiles</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>patient&#95;profiles&#95;user&#95;id&#95;unique</td>
                            <td>Unique Key ON user&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>patient_profiles_user_id_foreign</td>
                            <td> user&#95;id &#8599; <a href='#medlink&#46;users'
                                    onclick="window.scrollTo(427, 950);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.users').classList.add('palpable'); return false;">&#10063;
                                    users</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Referring Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>appointments_patient_profile_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;appointments'
                                    onclick="window.scrollTo(1643, 1197);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.appointments').classList.add('palpable'); return false;">&#10063;
                                    appointments</a>(patient&#95;profile&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>reviews_patient_profile_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;reviews'
                                    onclick="window.scrollTo(1377, 1007);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.reviews').classList.add('palpable'); return false;">&#10063;
                                    reviews</a>(patient&#95;profile&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>user_insurances_patient_profile_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;user&#95;insurances'
                                    onclick="window.scrollTo(636, 1121);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.user_insurances').classList.add('palpable'); return false;">&#10063;
                                    user&#95;insurances</a>(patient&#95;profile&#95;id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;22 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.personal_access_tokens'
                    onclick="window.scrollTo(199, 589);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.personal_access_tokens').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table personal_access_tokens</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.personal_access_tokens.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.personal_access_tokens.tokenable_type'>tokenable&#95;type</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.personal_access_tokens.tokenable_id'>tokenable&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.personal_access_tokens.name'>name</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.personal_access_tokens.token'>token</a></td>
                            <td class='dataType'> VARCHAR&#40;64&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.personal_access_tokens.abilities'>abilities</a></td>
                            <td class='dataType'> TEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.personal_access_tokens.last_used_at'>last&#95;used&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.personal_access_tokens.expires_at'>expires&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.personal_access_tokens.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.personal_access_tokens.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;personal&#95;access&#95;tokens</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>personal&#95;access&#95;tokens&#95;token&#95;unique</td>
                            <td>Unique Key ON token</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>personal&#95;access&#95;tokens&#95;tokenable&#95;type&#95;tokenable&#95;id&#95;index
                            </td>
                            <td>Index ON tokenable&#95;type&#44; tokenable&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;21 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.pulse_aggregates'
                    onclick="window.scrollTo(332, 133);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.pulse_aggregates').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table pulse_aggregates</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.pulse_aggregates.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.pulse_aggregates.bucket'>bucket</a></td>
                            <td class='dataType'> INT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.pulse_aggregates.period'>period</a></td>
                            <td class='dataType'> MEDIUMINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.pulse_aggregates.type'>type</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.pulse_aggregates.key'>key</a></td>
                            <td class='dataType'> MEDIUMTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.pulse_aggregates.key_hash'>key&#95;hash</a></td>
                            <td class='dataType'> BINARY&#40;16&#41; GENERATED ALWAYS AS (unhex(md5(`key`))) </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.pulse_aggregates.aggregate'>aggregate</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.pulse_aggregates.value'>value</a></td>
                            <td class='dataType'> DECIMAL&#40;20&#44;2&#41; </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.pulse_aggregates.count'>count</a></td>
                            <td class='dataType'> INT UNSIGNED </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;pulse&#95;aggregates</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>pulse&#95;aggregates&#95;bucket&#95;period&#95;type&#95;aggregate&#95;key&#95;hash&#95;unique
                            </td>
                            <td>Unique Key ON bucket&#44; period&#44; type&#44; aggregate&#44; key&#95;hash</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>pulse&#95;aggregates&#95;period&#95;bucket&#95;index</td>
                            <td>Index ON period&#44; bucket</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>pulse&#95;aggregates&#95;type&#95;index</td>
                            <td>Index ON type</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>pulse&#95;aggregates&#95;period&#95;type&#95;aggregate&#95;bucket&#95;index</td>
                            <td>Index ON period&#44; type&#44; aggregate&#44; bucket</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;4873 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.pulse_entries'
                    onclick="window.scrollTo(522, 133);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.pulse_entries').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table pulse_entries</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.pulse_entries.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.pulse_entries.timestamp'>timestamp</a></td>
                            <td class='dataType'> INT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.pulse_entries.type'>type</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.pulse_entries.key'>key</a></td>
                            <td class='dataType'> MEDIUMTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.pulse_entries.key_hash'>key&#95;hash</a></td>
                            <td class='dataType'> BINARY&#40;16&#41; GENERATED ALWAYS AS (unhex(md5(`key`))) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.pulse_entries.value'>value</a></td>
                            <td class='dataType'> BIGINT </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;pulse&#95;entries</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>pulse&#95;entries&#95;timestamp&#95;index</td>
                            <td>Index ON timestamp</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>pulse&#95;entries&#95;type&#95;index</td>
                            <td>Index ON type</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>pulse&#95;entries&#95;key&#95;hash&#95;index</td>
                            <td>Index ON key&#95;hash</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>pulse&#95;entries&#95;timestamp&#95;type&#95;key&#95;hash&#95;value&#95;index</td>
                            <td>Index ON timestamp&#44; type&#44; key&#95;hash&#44; value</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;1508 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.pulse_values'
                    onclick="window.scrollTo(484, 399);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.pulse_values').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table pulse_values</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.pulse_values.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.pulse_values.timestamp'>timestamp</a></td>
                            <td class='dataType'> INT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.pulse_values.type'>type</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.pulse_values.key'>key</a></td>
                            <td class='dataType'> MEDIUMTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.pulse_values.key_hash'>key&#95;hash</a></td>
                            <td class='dataType'> BINARY&#40;16&#41; GENERATED ALWAYS AS (unhex(md5(`key`))) </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.pulse_values.value'>value</a></td>
                            <td class='dataType'> MEDIUMTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;pulse&#95;values</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>pulse&#95;values&#95;type&#95;key&#95;hash&#95;unique</td>
                            <td>Unique Key ON type&#44; key&#95;hash</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>pulse&#95;values&#95;timestamp&#95;index</td>
                            <td>Index ON timestamp</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>pulse&#95;values&#95;type&#95;index</td>
                            <td>Index ON type</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.reviews'
                    onclick="window.scrollTo(1377, 1007);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.reviews').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table reviews</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.reviews.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.reviews.doctor_profile_id'>doctor&#95;profile&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.reviews.patient_profile_id'>patient&#95;profile&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.reviews.appointment_id'>appointment&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.reviews.review'>review</a></td>
                            <td class='dataType'> TEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.reviews.rate'>rate</a></td>
                            <td class='dataType'> DOUBLE </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.reviews.recommend'>recommend</a></td>
                            <td class='dataType'> BOOLEAN </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.reviews.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.reviews.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;reviews</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>reviews&#95;doctor&#95;profile&#95;id&#95;foreign</td>
                            <td>Index ON doctor&#95;profile&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>reviews&#95;patient&#95;profile&#95;id&#95;foreign</td>
                            <td>Index ON patient&#95;profile&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>reviews&#95;appointment&#95;id&#95;foreign</td>
                            <td>Index ON appointment&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>reviews_appointment_id_foreign</td>
                            <td> appointment&#95;id &#8599; <a href='#medlink&#46;appointments'
                                    onclick="window.scrollTo(1643, 1197);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.appointments').classList.add('palpable'); return false;">&#10063;
                                    appointments</a>(id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>reviews_doctor_profile_id_foreign</td>
                            <td> doctor&#95;profile&#95;id &#8599; <a href='#medlink&#46;doctor&#95;profiles'
                                    onclick="window.scrollTo(1111, 532);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.doctor_profiles').classList.add('palpable'); return false;">&#10063;
                                    doctor&#95;profiles</a>(id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>reviews_patient_profile_id_foreign</td>
                            <td> patient&#95;profile&#95;id &#8599; <a href='#medlink&#46;patient&#95;profiles'
                                    onclick="window.scrollTo(921, 1083);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.patient_profiles').classList.add('palpable'); return false;">&#10063;
                                    patient&#95;profiles</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;2 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.services'
                    onclick="window.scrollTo(1548, 475);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.services').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table services</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td><a name='medlink.services.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.services.icon'>icon</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.services.name'>name</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.services.description'>description</a></td>
                            <td class='dataType'> TEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.services.price'>price</a></td>
                            <td class='dataType'> DOUBLE </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.services.duration'>duration</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.services.buffer_time'>buffer&#95;time</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.services.seat'>seat</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.services.is_active'>is&#95;active</a></td>
                            <td class='dataType'> BOOLEAN DEFAULT '1' </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.services.doctor_profile_id'>doctor&#95;profile&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.services.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.services.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;services</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>services&#95;doctor&#95;profile&#95;id&#95;foreign</td>
                            <td>Index ON doctor&#95;profile&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>services_doctor_profile_id_foreign</td>
                            <td> doctor&#95;profile&#95;id &#8599; <a href='#medlink&#46;doctor&#95;profiles'
                                    onclick="window.scrollTo(1111, 532);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.doctor_profiles').classList.add('palpable'); return false;">&#10063;
                                    doctor&#95;profiles</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Referring Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>appointments_service_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;appointments'
                                    onclick="window.scrollTo(1643, 1197);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.appointments').classList.add('palpable'); return false;">&#10063;
                                    appointments</a>(service&#95;id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;41 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.sessions'
                    onclick="window.scrollTo(60, 361);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.sessions').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table sessions</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.sessions.id'>id</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.sessions.user_id'>user&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.sessions.ip_address'>ip&#95;address</a></td>
                            <td class='dataType'> VARCHAR&#40;45&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.sessions.user_agent'>user&#95;agent</a></td>
                            <td class='dataType'> TEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.sessions.payload'>payload</a></td>
                            <td class='dataType'> LONGTEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.sessions.last_activity'>last&#95;activity</a></td>
                            <td class='dataType'> INT </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;sessions</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>sessions&#95;user&#95;id&#95;index</td>
                            <td>Index ON user&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>sessions&#95;last&#95;activity&#95;index</td>
                            <td>Index ON last&#95;activity</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.supports'
                    onclick="window.scrollTo(199, 1121);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.supports').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table supports</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.supports.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.supports.user_id'>user&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.supports.appointment_id'>appointment&#95;id</a></td>
                            <td class='dataType'> BIGINT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.supports.message'>message</a></td>
                            <td class='dataType'> TEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.supports.status'>status</a></td>
                            <td class='dataType'> ENUM&#40;&#39;open&#39;&#44;&#39;closed&#39;&#41; COLLATE
                                utf8mb4&#95;unicode&#95;ci DEFAULT 'open' </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.supports.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.supports.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;supports</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>supports&#95;user&#95;id&#95;foreign</td>
                            <td>Index ON user&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>supports_user_id_foreign</td>
                            <td> user&#95;id &#8599; <a href='#medlink&#46;users'
                                    onclick="window.scrollTo(427, 950);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.users').classList.add('palpable'); return false;">&#10063;
                                    users</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;2 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.transaction_histories'
                    onclick="window.scrollTo(712, 608);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.transaction_histories').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table transaction_histories</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.transaction_histories.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.transaction_histories.user_id'>user&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.transaction_histories.reason'>reason</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.transaction_histories.amount'>amount</a></td>
                            <td class='dataType'> DOUBLE </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.transaction_histories.type'>type</a></td>
                            <td class='dataType'> ENUM&#40;&#39;deposit&#39;&#44;&#39;withdraw&#39;&#41; COLLATE
                                utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.transaction_histories.status'>status</a></td>
                            <td class='dataType'> ENUM&#40;&#39;pending&#39;&#44;&#39;success&#39;&#41; COLLATE
                                utf8mb4&#95;unicode&#95;ci DEFAULT 'pending' </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transaction_histories.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transaction_histories.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;transaction&#95;histories</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>transaction&#95;histories&#95;user&#95;id&#95;foreign</td>
                            <td>Index ON user&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>transaction_histories_user_id_foreign</td>
                            <td> user&#95;id &#8599; <a href='#medlink&#46;users'
                                    onclick="window.scrollTo(427, 950);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.users').classList.add('palpable'); return false;">&#10063;
                                    users</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.transactions'
                    onclick="window.scrollTo(693, 285);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.transactions').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table transactions</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td><a name='medlink.transactions.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.transactions.payable_type'>payable&#95;type</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.transactions.payable_id'>payable&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.transactions.wallet_id'>wallet&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.transactions.type'>type</a></td>
                            <td class='dataType'> ENUM&#40;&#39;deposit&#39;&#44;&#39;withdraw&#39;&#41; COLLATE
                                utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.transactions.amount'>amount</a></td>
                            <td class='dataType'> DECIMAL&#40;64&#44;0&#41; </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.transactions.confirmed'>confirmed</a></td>
                            <td class='dataType'> BOOLEAN </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transactions.meta'>meta</a></td>
                            <td class='dataType'> JSON </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transactions.meta.payosId'>meta&#46;payosId</a></td>
                            <td class='dataType'> &#95;string </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transactions.meta.description'>meta&#46;description</a></td>
                            <td class='dataType'> &#95;string </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.transactions.uuid'>uuid</a></td>
                            <td class='dataType'> CHAR&#40;36&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transactions.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transactions.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transactions.deleted_at'>deleted&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;transactions</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>transactions&#95;uuid&#95;unique</td>
                            <td>Unique Key ON uuid</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>payable&#95;type&#95;payable&#95;id&#95;ind</td>
                            <td>Index ON payable&#95;type&#44; payable&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>payable&#95;type&#95;ind</td>
                            <td>Index ON payable&#95;type&#44; payable&#95;id&#44; type</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>payable&#95;confirmed&#95;ind</td>
                            <td>Index ON payable&#95;type&#44; payable&#95;id&#44; confirmed</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>payable&#95;type&#95;confirmed&#95;ind</td>
                            <td>Index ON payable&#95;type&#44; payable&#95;id&#44; type&#44; confirmed</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>transactions&#95;type&#95;index</td>
                            <td>Index ON type</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>transactions&#95;wallet&#95;id&#95;foreign</td>
                            <td>Index ON wallet&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>transactions_wallet_id_foreign</td>
                            <td> wallet&#95;id &#8599; <a href='#medlink&#46;wallets'
                                    onclick="window.scrollTo(902, 551);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.wallets').classList.add('palpable'); return false;">&#10063;
                                    wallets</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Referring Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>transfers_deposit_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;transfers'
                                    onclick="window.scrollTo(940, 190);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.transfers').classList.add('palpable'); return false;">&#10063;
                                    transfers</a>(deposit&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>transfers_withdraw_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;transfers'
                                    onclick="window.scrollTo(940, 190);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.transfers').classList.add('palpable'); return false;">&#10063;
                                    transfers</a>(withdraw&#95;id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;2 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.transfers'
                    onclick="window.scrollTo(940, 190);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.transfers').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table transfers</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.transfers.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.transfers.from_id'>from&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td><a name='medlink.transfers.to_id'>to&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.transfers.status'>status</a></td>
                            <td class='dataType'>
                                ENUM&#40;&#39;exchange&#39;&#44;&#39;transfer&#39;&#44;&#39;paid&#39;&#44;&#39;refund&#39;&#44;&#39;gift&#39;&#41;
                                COLLATE utf8mb4&#95;unicode&#95;ci DEFAULT 'transfer' </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transfers.status_last'>status&#95;last</a></td>
                            <td class='dataType'>
                                ENUM&#40;&#39;exchange&#39;&#44;&#39;transfer&#39;&#44;&#39;paid&#39;&#44;&#39;refund&#39;&#44;&#39;gift&#39;&#41;
                                COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.transfers.deposit_id'>deposit&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.transfers.withdraw_id'>withdraw&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.transfers.discount'>discount</a></td>
                            <td class='dataType'> DECIMAL&#40;64&#44;0&#41; DEFAULT '0' </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.transfers.fee'>fee</a></td>
                            <td class='dataType'> DECIMAL&#40;64&#44;0&#41; DEFAULT '0' </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transfers.extra'>extra</a></td>
                            <td class='dataType'> JSON </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.transfers.uuid'>uuid</a></td>
                            <td class='dataType'> CHAR&#40;36&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transfers.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transfers.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.transfers.deleted_at'>deleted&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;transfers</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>transfers&#95;uuid&#95;unique</td>
                            <td>Unique Key ON uuid</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>transfers&#95;deposit&#95;id&#95;foreign</td>
                            <td>Index ON deposit&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>transfers&#95;withdraw&#95;id&#95;foreign</td>
                            <td>Index ON withdraw&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>transfers&#95;from&#95;id&#95;index</td>
                            <td>Index ON from&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>transfers&#95;to&#95;id&#95;index</td>
                            <td>Index ON to&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>transfers_deposit_id_foreign</td>
                            <td> deposit&#95;id &#8599; <a href='#medlink&#46;transactions'
                                    onclick="window.scrollTo(693, 285);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.transactions').classList.add('palpable'); return false;">&#10063;
                                    transactions</a>(id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>transfers_withdraw_id_foreign</td>
                            <td> withdraw&#95;id &#8599; <a href='#medlink&#46;transactions'
                                    onclick="window.scrollTo(693, 285);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.transactions').classList.add('palpable'); return false;">&#10063;
                                    transactions</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.user_insurances'
                    onclick="window.scrollTo(636, 1121);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.user_insurances').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table user_insurances</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.user_insurances.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.user_insurances.patient_profile_id'>patient&#95;profile&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_insurances.insurance_type'>insurance&#95;type</a></td>
                            <td class='dataType'>
                                ENUM&#40;&#39;public&#39;&#44;&#39;private&#39;&#44;&#39;vietnamese&#39;&#41; COLLATE
                                utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_insurances.insurance_number'>insurance&#95;number</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_insurances.registry'>registry</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_insurances.registered_address'>registered&#95;address</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_insurances.valid_from'>valid&#95;from</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_insurances.main_insured'>main&#95;insured</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_insurances.entitled_insured'>entitled&#95;insured</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_insurances.assurance_type'>assurance&#95;type</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_insurances.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_insurances.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;user&#95;insurances</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>user&#95;insurances&#95;patient&#95;profile&#95;id&#95;unique</td>
                            <td>Unique Key ON patient&#95;profile&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>user_insurances_patient_profile_id_foreign</td>
                            <td> patient&#95;profile&#95;id &#8599; <a href='#medlink&#46;patient&#95;profiles'
                                    onclick="window.scrollTo(921, 1083);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.patient_profiles').classList.add('palpable'); return false;">&#10063;
                                    patient&#95;profiles</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;22 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.user_languages'
                    onclick="window.scrollTo(180, 931);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.user_languages').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table user_languages</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.user_languages.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.user_languages.user_id'>user&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.user_languages.language_id'>language&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_languages.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_languages.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;user&#95;languages</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>user&#95;languages&#95;user&#95;id&#95;foreign</td>
                            <td>Index ON user&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>user&#95;languages&#95;language&#95;id&#95;foreign</td>
                            <td>Index ON language&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>user_languages_language_id_foreign</td>
                            <td> language&#95;id &#8599; <a href='#medlink&#46;languages'
                                    onclick="window.scrollTo(60, 931);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.languages').classList.add('palpable'); return false;">&#10063;
                                    languages</a>(id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>user_languages_user_id_foreign</td>
                            <td> user&#95;id &#8599; <a href='#medlink&#46;users'
                                    onclick="window.scrollTo(427, 950);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.users').classList.add('palpable'); return false;">&#10063;
                                    users</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;13 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.user_settings'
                    onclick="window.scrollTo(60, 1159);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.user_settings').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table user_settings</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.user_settings.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.user_settings.user_id'>user&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.user_settings.name'>name</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.user_settings.value'>value</a></td>
                            <td class='dataType'> BOOLEAN </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_settings.description'>description</a></td>
                            <td class='dataType'> TEXT COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_settings.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.user_settings.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;user&#95;settings</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>user&#95;settings&#95;user&#95;id&#95;foreign</td>
                            <td>Index ON user&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>user_settings_user_id_foreign</td>
                            <td> user&#95;id &#8599; <a href='#medlink&#46;users'
                                    onclick="window.scrollTo(427, 950);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.users').classList.add('palpable'); return false;">&#10063;
                                    users</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;321 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.users'
                    onclick="window.scrollTo(427, 950);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.users').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table users</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td><a name='medlink.users.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.users.user_type'>user&#95;type</a></td>
                            <td class='dataType'>
                                ENUM&#40;&#39;healthcare&#39;&#44;&#39;patient&#39;&#44;&#39;admin&#39;&#41; COLLATE
                                utf8mb4&#95;unicode&#95;ci DEFAULT 'patient' </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.users.identity'>identity</a></td>
                            <td class='dataType'>
                                ENUM&#40;&#39;none&#39;&#44;&#39;doctor&#39;&#44;&#39;pharmacies&#39;&#44;&#39;hospital&#39;&#44;&#39;ambulance&#39;&#41;
                                COLLATE utf8mb4&#95;unicode&#95;ci DEFAULT 'none' </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.users.email'>email</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.users.password'>password</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.avatar'>avatar</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.name'>name</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.gender'>gender</a></td>
                            <td class='dataType'> ENUM&#40;&#39;male&#39;&#44;&#39;female&#39;&#44;&#39;other&#39;&#41;
                                COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.country_code'>country&#95;code</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.phone'>phone</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.latitude'>latitude</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.longitude'>longitude</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.country'>country</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.city'>city</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.state'>state</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.address'>address</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.zip_code'>zip&#95;code</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.users.status'>status</a></td>
                            <td class='dataType'>
                                ENUM&#40;&#39;suspend&#39;&#44;&#39;waiting&#45;approval&#39;&#44;&#39;active&#39;&#41;
                                COLLATE utf8mb4&#95;unicode&#95;ci DEFAULT 'active' </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.deleted_at'>deleted&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.last_login'>last&#95;login</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.remember_token'>remember&#95;token</a></td>
                            <td class='dataType'> VARCHAR&#40;100&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.users.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;users</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>users&#95;email&#95;unique</td>
                            <td>Unique Key ON email</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Referring Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>doctor_profiles_user_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;doctor&#95;profiles'
                                    onclick="window.scrollTo(1111, 532);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.doctor_profiles').classList.add('palpable'); return false;">&#10063;
                                    doctor&#95;profiles</a>(user&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>favorites_doctor_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;favorites'
                                    onclick="window.scrollTo(161, 1368);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.favorites').classList.add('palpable'); return false;">&#10063;
                                    favorites</a>(doctor&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>favorites_patient_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;favorites'
                                    onclick="window.scrollTo(161, 1368);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.favorites').classList.add('palpable'); return false;">&#10063;
                                    favorites</a>(patient&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>notifications_user_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;notifications'
                                    onclick="window.scrollTo(427, 1501);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.notifications').classList.add('palpable'); return false;">&#10063;
                                    notifications</a>(user&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>patient_profiles_user_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;patient&#95;profiles'
                                    onclick="window.scrollTo(921, 1083);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.patient_profiles').classList.add('palpable'); return false;">&#10063;
                                    patient&#95;profiles</a>(user&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>supports_user_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;supports'
                                    onclick="window.scrollTo(199, 1121);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.supports').classList.add('palpable'); return false;">&#10063;
                                    supports</a>(user&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>transaction_histories_user_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;transaction&#95;histories'
                                    onclick="window.scrollTo(712, 608);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.transaction_histories').classList.add('palpable'); return false;">&#10063;
                                    transaction&#95;histories</a>(user&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>user_languages_user_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;user&#95;languages'
                                    onclick="window.scrollTo(180, 931);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.user_languages').classList.add('palpable'); return false;">&#10063;
                                    user&#95;languages</a>(user&#95;id) </td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>user_settings_user_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;user&#95;settings'
                                    onclick="window.scrollTo(60, 1159);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.user_settings').classList.add('palpable'); return false;">&#10063;
                                    user&#95;settings</a>(user&#95;id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;42 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.wallets'
                    onclick="window.scrollTo(902, 551);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.wallets').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table wallets</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td><a name='medlink.wallets.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.wallets.holder_type'>holder&#95;type</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.wallets.holder_id'>holder&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.wallets.name'>name</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.wallets.slug'>slug</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td><a name='medlink.wallets.uuid'>uuid</a></td>
                            <td class='dataType'> CHAR&#40;36&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.wallets.description'>description</a></td>
                            <td class='dataType'> VARCHAR&#40;255&#41; COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.wallets.meta'>meta</a></td>
                            <td class='dataType'> JSON </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.wallets.balance'>balance</a></td>
                            <td class='dataType'> DECIMAL&#40;64&#44;0&#41; DEFAULT '0' </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.wallets.decimal_places'>decimal&#95;places</a></td>
                            <td class='dataType'> SMALLINT UNSIGNED DEFAULT '2' </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.wallets.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.wallets.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.wallets.deleted_at'>deleted&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;wallets</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>wallets&#95;holder&#95;type&#95;holder&#95;id&#95;slug&#95;unique</td>
                            <td>Unique Key ON holder&#95;type&#44; holder&#95;id&#44; slug</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#unq' />
                                </svg></td>
                            <td>wallets&#95;uuid&#95;unique</td>
                            <td>Unique Key ON uuid</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>wallets&#95;holder&#95;type&#95;holder&#95;id&#95;index</td>
                            <td>Index ON holder&#95;type&#44; holder&#95;id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>wallets&#95;slug&#95;index</td>
                            <td>Index ON slug</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Referring Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#ref' />
                                </svg></td>
                            <td>transactions_wallet_id_foreign</td>
                            <td> id &#8601; <a href='#medlink&#46;transactions'
                                    onclick="window.scrollTo(693, 285);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.transactions').classList.add('palpable'); return false;">&#10063;
                                    transactions</a>(wallet&#95;id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;2 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br><br>
        <div class='card custom-card'>
            <div class='card-body'><a name='medlink.work_schedules'
                    onclick="window.scrollTo(1130, 171);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.work_schedules').classList.add('palpable'); return false;"
                    style='cursor:pointer;'>
                    <h5 class='card-title text-center'>Table work_schedules</h5>
                </a>
                <table class='table table-sm small' style='table-layout: fixed; word-wrap: break-word;'>
                    <thead>
                        <tr>
                            <th style='width:5%'>Idx</th>
                            <th style='width:40%'>Column Name</th>
                            <th>Data Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td><a name='medlink.work_schedules.id'>id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED AUTO_INCREMENT </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td><a name='medlink.work_schedules.doctor_profile_id'>doctor&#95;profile&#95;id</a></td>
                            <td class='dataType'> BIGINT UNSIGNED </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.work_schedules.day_of_week'>day&#95;of&#95;week</a></td>
                            <td class='dataType'>
                                ENUM&#40;&#39;Sunday&#39;&#44;&#39;Monday&#39;&#44;&#39;Tuesday&#39;&#44;&#39;Wednesday&#39;&#44;&#39;Thursday&#39;&#44;&#39;Friday&#39;&#44;&#39;Saturday&#39;&#41;
                                COLLATE utf8mb4&#95;unicode&#95;ci </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.work_schedules.start_time'>start&#95;time</a></td>
                            <td class='dataType'> TIME </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.work_schedules.end_time'>end&#95;time</a></td>
                            <td class='dataType'> TIME </td>
                        </tr>
                        <tr>
                            <td><span class='text-danger'>*</span></td>
                            <td><a name='medlink.work_schedules.all_day'>all&#95;day</a></td>
                            <td class='dataType'> BOOLEAN DEFAULT '0' </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.work_schedules.created_at'>created&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><a name='medlink.work_schedules.updated_at'>updated&#95;at</a></td>
                            <td class='dataType'> TIMESTAMP </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Indexes</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#pk' />
                                </svg></td>
                            <td>pk&#95;work&#95;schedules</td>
                            <td>Primary Key ON id</td>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#idx' />
                                </svg></td>
                            <td>work&#95;schedules&#95;doctor&#95;profile&#95;id&#95;foreign</td>
                            <td>Index ON doctor&#95;profile&#95;id</td>
                        </tr>
                        <tr>
                            <th colspan='3'>Foreign Key</th>
                        </tr>
                        <tr>
                            <td><svg width='14' height='14'>
                                    <use xlink:href='#fk' />
                                </svg></td>
                            <td>work_schedules_doctor_profile_id_foreign</td>
                            <td> doctor&#95;profile&#95;id &#8599; <a href='#medlink&#46;doctor&#95;profiles'
                                    onclick="window.scrollTo(1111, 532);var nodes = document.getElementsByClassName('palpable');for (var i = 0; i < nodes.length; i++) { nodes[i].classList.remove('palpable');}; document.getElementById('depict_medlink.doctor_profiles').classList.add('palpable'); return false;">&#10063;
                                    doctor&#95;profiles</a>(id) </td>
                        </tr>
                        <tr>
                            <th colspan='3'>Options</th>
                        </tr>
                        <tr>
                            <td colspan='3'>ENGINE&#61;InnoDB AUTO&#95;INCREMENT&#61;31 DEFAULT CHARSET&#61;utf8mb4
                                COLLATE&#61;utf8mb4&#95;unicode&#95;ci</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <br><br>
</body>

</html>