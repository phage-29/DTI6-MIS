<?php

require_once "assets/components/includes/conn.php";
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $query = "
    SELECT
        h.id,
        h.request_number,
        h.requested_by,
        CONCAT(u1.first_name, ' ', u1.last_name) AS requested_by_name,
        u1.first_name,
        u1.middle_name,
        u1.last_name,
        u1.client_type_id,
        ct.client_type,
        u1.division_id,
        d.division,
        u1.sex,
        u1.phone,
        u1.email,
        u1.date_birth,
        h.date_requested,
        h.request_type_id,
        rt.request_type,
        h.category_id,
        c.category,
        h.sub_category_id,
        sc.sub_category,
        h.complaint,
        h.datetime_preferred,
        h.status_id,
        hs.status,
        hs.color,
        hs.color_hex,
        h.sent_id,
        hs1.status AS sent_status,
        hs1.color AS sent_color,
        hs1.color_hex AS sent_color_hex,
        h.priority_level_id,
        pl.priority_level,
        h.repair_type_id,
        rt2.repair_type,
        h.repair_class_id,
        rc.repair_class,
        h.medium_id,
        m.medium,
        h.assigned_to,
        CONCAT(u2.first_name, ' ', u2.last_name) AS assigned_to_name,
        h.approved_by,
        CONCAT(u3.first_name, ' ', u3.last_name) AS approved_by_name,
        h.serviced_by,
        CONCAT(u4.first_name, ' ', u4.last_name) AS serviced_by_name,
        h.datetime_start,
        h.datetime_end,
        h.diagnosis,
        h.remarks,
        h.created_at,
        h.updated_at,
        c2.id AS csf_id,
        c2.crit1,
        c2.crit2,
        c2.crit3,
        c2.crit4,
        c2.overall,
        c2.reasons,
        c2.comments,
        c2.created_at AS created_csf_at,
        c2.updated_at AS updated_csf_at
    FROM
        helpdesks AS h
        LEFT JOIN users AS u1 ON h.requested_by = u1.id
        LEFT JOIN divisions AS d ON u1.division_id = d.id
        LEFT JOIN client_types AS ct ON u1.client_type_id = ct.id
        LEFT JOIN request_types AS rt ON h.request_type_id = rt.id
        LEFT JOIN categories AS c ON h.category_id = c.id
        LEFT JOIN sub_categories AS sc ON h.sub_category_id = sc.id
        LEFT JOIN helpdesks_statuses AS hs ON h.status_id = hs.id
        LEFT JOIN helpdesks_statuses AS hs1 ON h.sent_id = hs1.id
        LEFT JOIN priority_levels AS pl ON h.priority_level_id = pl.id
        LEFT JOIN repair_types AS rt2 ON h.repair_type_id = rt2.id
        LEFT JOIN repair_classes AS rc ON h.repair_class_id = rc.id
        LEFT JOIN mediums AS m ON h.medium_id = m.id
        LEFT JOIN users AS u2 ON h.assigned_to = u2.id
        LEFT JOIN users AS u3 ON h.approved_by = u3.id
        LEFT JOIN users AS u4 ON h.serviced_by = u4.id
        LEFT JOIN csf c2 ON h.id = c2.helpdesks_id
    WHERE 
        h.id = ?
    ";

    $result = $conn->execute_query($query, [$id]);
    $row = $result->fetch_object();
}
?>
<!DOCTYPE html>
<html lang="en-PH">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>
    </title>
    <style>
        @page {
            size: 'A4';
        }

        body {
            line-height: 108%;
            font-family: Calibri;
            font-size: 11pt
        }

        h2,
        p {
            margin: 0pt 0pt 8pt
        }

        table {
            margin-top: 0pt;
            margin-bottom: 8pt
        }

        h2 {
            margin-top: 2pt;
            margin-bottom: 0pt;
            page-break-inside: avoid;
            page-break-after: avoid;
            line-height: 108%;
            font-family: 'Calibri Light';
            font-size: 13pt;
            font-weight: normal;
            color: #2e74b5
        }

        .NoSpacing {
            margin-bottom: 0pt;
            line-height: normal;
            font-size: 11pt
        }

        span.Heading2Char {
            font-family: 'Calibri Light';
            font-size: 13pt;
            color: #2e74b5
        }
    </style>
</head>

<body>
    <div id="page1" style="border: 1px solid black">
        <table
            style="margin-right:9pt; margin-left:9pt; margin-bottom:0pt; border:0.75pt solid #000000; border-collapse:collapse; float:right;">
            <tbody>
                <tr>
                    <td rowspan="3"
                        style="border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle;">
                        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">F</span></p>
                        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">O</span></p>
                        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">R</span></p>
                        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">M</span></p>
                    </td>
                    <td
                        style="border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle;">
                        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">Code</span></p>
                    </td>
                    <td
                        style="border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle;">
                        <p class="NoSpacing" style="font-size:10pt;"><span
                                style="font-family:Arial;">FM-GAS-MOT-03</span></p>
                    </td>
                </tr>
                <tr style="height:3.85pt;">
                    <td
                        style="border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle;">
                        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">Rev.</span></p>
                    </td>
                    <td
                        style="border-top:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle;">
                        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">0</span></p>
                    </td>
                </tr>
                <tr style="height:3.85pt;">
                    <td
                        style="border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle;">
                        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">Date</span></p>
                    </td>
                    <td
                        style="border-top:0.75pt solid #000000; border-left:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle;">
                        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">01-May-23</span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="NoSpacing" style="line-height:150%; margin-left:310px;"><span
                style="height:0pt; display:block; position:absolute; z-index:0;">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="75px"
                    height="75px" viewBox="0 0 80 80" version="1.1">
                    <defs>
                        <filter id="alpha" filterUnits="objectBoundingBox" x="0%" y="0%" width="100%" height="100%">
                            <feColorMatrix type="matrix" in="SourceGraphic"
                                values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 1 0" />
                        </filter>
                        <mask id="mask0">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.976471;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip1">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface5" clip-path="url(#clip1)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(16.470588%,24.313725%,49.803922%);fill-opacity:1;"
                                d="M 65.554688 1.554688 C 72.074219 2.226562 75.484375 5.855469 75.777344 12.445312 C 75.101562 20.554688 70.804688 23.8125 62.890625 22.222656 C 57.765625 19.3125 55.914062 14.941406 57.332031 9.109375 C 58.496094 4.800781 61.238281 2.28125 65.554688 1.554688 Z M 65.554688 1.554688 " />
                        </g>
                        <mask id="mask1">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.984314;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip2">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface8" clip-path="url(#clip2)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(14.901961%,23.529412%,50.196078%);fill-opacity:1;"
                                d="M 23.777344 14.445312 C 27.628906 14.445312 31.480469 14.445312 35.332031 14.445312 C 35.332031 18 35.332031 21.554688 35.332031 25.109375 C 37.554688 25.109375 39.777344 25.109375 42 25.109375 C 42 21.554688 42 18 42 14.445312 C 45.703125 14.445312 49.40625 14.445312 53.109375 14.445312 C 53.109375 18 53.109375 21.554688 53.109375 25.109375 C 59.332031 25.109375 65.554688 25.109375 71.777344 25.109375 C 71.777344 35.777344 71.777344 46.445312 71.777344 57.109375 C 68.074219 57.109375 64.371094 57.109375 60.667969 57.109375 C 60.667969 49.257812 60.667969 41.40625 60.667969 33.554688 C 58.148438 33.554688 55.628906 33.554688 53.109375 33.554688 C 52.921875 38.035156 53.144531 42.480469 53.777344 46.890625 C 54 47.109375 54.222656 47.332031 54.445312 47.554688 C 55.917969 47.777344 57.398438 47.851562 58.890625 47.777344 C 58.890625 50.890625 58.890625 54 58.890625 57.109375 C 55.183594 57.183594 51.480469 57.109375 47.777344 56.890625 C 44.660156 55.84375 42.808594 53.695312 42.222656 50.445312 C 42 44.816406 41.925781 39.1875 42 33.554688 C 39.777344 33.554688 37.554688 33.554688 35.332031 33.554688 C 35.332031 41.40625 35.332031 49.257812 35.332031 57.109375 C 31.777344 57.109375 28.222656 57.109375 24.667969 57.109375 C 25.058594 53.496094 24.539062 53.050781 23.109375 55.777344 C 16.0625 59.601562 10.875 57.824219 7.554688 50.445312 C 5.40625 43.878906 5.554688 37.359375 8 30.890625 C 11.789062 24.441406 16.898438 23.109375 23.332031 26.890625 C 23.777344 22.75 23.925781 18.601562 23.777344 14.445312 Z M 20.667969 32.667969 C 21.988281 32.730469 22.953125 33.324219 23.554688 34.445312 C 23.851562 38.59375 23.851562 42.742188 23.554688 46.890625 C 21.578125 49.878906 19.800781 49.730469 18.222656 46.445312 C 17.539062 42.585938 17.6875 38.734375 18.667969 34.890625 C 19.121094 33.917969 19.789062 33.175781 20.667969 32.667969 Z M 20.667969 32.667969 " />
                        </g>
                        <mask id="mask2">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.996078;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip3">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface11" clip-path="url(#clip3)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(70.980392%,69.803922%,22.745098%);fill-opacity:1;"
                                d="M 71.332031 13.554688 C 71.246094 14.648438 70.949219 15.6875 70.445312 16.667969 C 69.851562 15.335938 70.148438 14.296875 71.332031 13.554688 Z M 71.332031 13.554688 " />
                        </g>
                        <mask id="mask3">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.94902;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip4">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface14" clip-path="url(#clip4)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(17.254902%,23.529412%,49.803922%);fill-opacity:1;"
                                d="M 71.777344 61.109375 C 50.113281 62.746094 28.484375 64.671875 6.890625 66.890625 C 6.890625 64.667969 6.890625 62.445312 6.890625 60.222656 C 28.671875 59.929688 50.300781 60.222656 71.777344 61.109375 Z M 71.777344 61.109375 " />
                        </g>
                        <mask id="mask4">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.976471;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip5">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface17" clip-path="url(#clip5)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(91.372549%,10.980392%,14.509804%);fill-opacity:1;"
                                d="M 71.777344 61.109375 C 71.777344 63.183594 71.777344 65.257812 71.777344 67.332031 C 50.074219 67.480469 28.441406 67.332031 6.890625 66.890625 C 28.484375 64.671875 50.113281 62.746094 71.777344 61.109375 Z M 71.777344 61.109375 " />
                        </g>
                        <mask id="mask5">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.882353;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip6">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface20" clip-path="url(#clip6)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(14.901961%,23.137255%,49.411765%);fill-opacity:1;"
                                d="M 6.890625 70.445312 C 9.332031 70.148438 10.296875 71.183594 9.777344 73.554688 C 8.683594 74.113281 8.164062 75.003906 8.222656 76.222656 C 7.777344 76.222656 7.332031 76.222656 6.890625 76.222656 C 6.890625 74.296875 6.890625 72.371094 6.890625 70.445312 Z M 6.890625 70.445312 " />
                        </g>
                        <mask id="mask6">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.729412;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip7">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface23" clip-path="url(#clip7)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(14.509804%,23.529412%,50.196078%);fill-opacity:1;"
                                d="M 13.554688 70.445312 C 14 70.445312 14.445312 70.445312 14.890625 70.445312 C 15.035156 73.40625 15.183594 73.40625 15.332031 70.445312 C 15.777344 70.445312 16.222656 70.445312 16.667969 70.445312 C 16.667969 72.371094 16.667969 74.296875 16.667969 76.222656 C 16.222656 76.222656 15.777344 76.222656 15.332031 76.222656 C 15.183594 73.257812 15.035156 73.257812 14.890625 76.222656 C 14.445312 76.222656 14 76.222656 13.554688 76.222656 C 13.554688 74.296875 13.554688 72.371094 13.554688 70.445312 Z M 13.554688 70.445312 " />
                        </g>
                        <mask id="mask7">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.862745;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip8">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface26" clip-path="url(#clip8)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(14.901961%,22.745098%,50.196078%);fill-opacity:1;"
                                d="M 20.222656 70.445312 C 20.667969 70.445312 21.109375 70.445312 21.554688 70.445312 C 21.554688 72.371094 21.554688 74.296875 21.554688 76.222656 C 21.109375 76.222656 20.667969 76.222656 20.222656 76.222656 C 20.222656 74.296875 20.222656 72.371094 20.222656 70.445312 Z M 20.222656 70.445312 " />
                        </g>
                        <mask id="mask8">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.85098;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip9">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface29" clip-path="url(#clip9)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(14.509804%,23.529412%,50.588235%);fill-opacity:1;"
                                d="M 25.554688 70.445312 C 26 70.445312 26.445312 70.445312 26.890625 70.445312 C 26.890625 71.925781 26.890625 73.40625 26.890625 74.890625 C 27.332031 74.890625 27.777344 74.890625 28.222656 74.890625 C 28.222656 75.332031 28.222656 75.777344 28.222656 76.222656 C 27.332031 76.222656 26.445312 76.222656 25.554688 76.222656 C 25.554688 74.296875 25.554688 72.371094 25.554688 70.445312 Z M 25.554688 70.445312 " />
                        </g>
                        <mask id="mask9">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.784314;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip10">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface32" clip-path="url(#clip10)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(12.941176%,18.431373%,38.431373%);fill-opacity:1;"
                                d="M 31.777344 70.445312 C 32.355469 71.210938 32.652344 72.171875 32.667969 73.332031 C 32.519531 74.296875 32.371094 75.257812 32.222656 76.222656 C 31.960938 76.128906 31.738281 75.980469 31.554688 75.777344 C 31.214844 73.960938 31.289062 72.183594 31.777344 70.445312 Z M 31.777344 70.445312 " />
                        </g>
                        <mask id="mask10">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.776471;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip11">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface35" clip-path="url(#clip11)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(14.901961%,23.137255%,49.411765%);fill-opacity:1;"
                                d="M 36.667969 70.445312 C 39.410156 69.855469 40.375 70.890625 39.554688 73.554688 C 38.460938 74.113281 37.945312 75.003906 38 76.222656 C 37.554688 76.222656 37.109375 76.222656 36.667969 76.222656 C 36.667969 74.296875 36.667969 72.371094 36.667969 70.445312 Z M 36.667969 70.445312 " />
                        </g>
                        <mask id="mask11">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.831373;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip12">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface38" clip-path="url(#clip12)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(14.509804%,23.529412%,50.196078%);fill-opacity:1;"
                                d="M 43.332031 70.445312 C 46.324219 69.992188 47.214844 71.175781 46 74 C 44.988281 74.390625 44.546875 75.128906 44.667969 76.222656 C 44.222656 76.222656 43.777344 76.222656 43.332031 76.222656 C 43.332031 74.296875 43.332031 72.371094 43.332031 70.445312 Z M 43.332031 70.445312 " />
                        </g>
                        <mask id="mask12">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.858824;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip13">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface41" clip-path="url(#clip13)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(14.509804%,23.529412%,49.803922%);fill-opacity:1;"
                                d="M 55.332031 70.445312 C 56.054688 70.382812 56.574219 70.679688 56.890625 71.332031 C 57.203125 70.679688 57.722656 70.382812 58.445312 70.445312 C 58.445312 72.371094 58.445312 74.296875 58.445312 76.222656 C 57.179688 76.085938 56.511719 75.34375 56.445312 74 C 56.355469 74.78125 56.132812 75.519531 55.777344 76.222656 C 55.335938 74.320312 55.1875 72.394531 55.332031 70.445312 Z M 55.332031 70.445312 " />
                        </g>
                        <mask id="mask13">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.819608;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip14">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface44" clip-path="url(#clip14)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(14.509804%,22.745098%,50.980392%);fill-opacity:1;"
                                d="M 62 70.445312 C 63.035156 70.445312 64.074219 70.445312 65.109375 70.445312 C 65.109375 71.035156 65.109375 71.628906 65.109375 72.222656 C 63.183594 72.277344 63.035156 72.425781 64.667969 72.667969 C 64.667969 73.109375 64.667969 73.554688 64.667969 74 C 64.144531 73.902344 63.699219 74.050781 63.332031 74.445312 C 63.863281 74.855469 64.453125 75.003906 65.109375 74.890625 C 65.109375 75.332031 65.109375 75.777344 65.109375 76.222656 C 64.074219 76.222656 63.035156 76.222656 62 76.222656 C 62 74.296875 62 72.371094 62 70.445312 Z M 62 70.445312 " />
                        </g>
                        <mask id="mask14">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.662745;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip15">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface47" clip-path="url(#clip15)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(14.117647%,23.529412%,50.196078%);fill-opacity:1;"
                                d="M 50 70.445312 C 50.445312 70.445312 50.890625 70.445312 51.332031 70.445312 C 51.332031 72.371094 51.332031 74.296875 51.332031 76.222656 C 50.890625 76.222656 50.445312 76.222656 50 76.222656 C 50 74.296875 50 72.371094 50 70.445312 Z M 50 70.445312 " />
                        </g>
                        <mask id="mask15">
                            <g filter="url(#alpha)">
                                <rect x="0" y="0" width="80" height="80"
                                    style="fill:rgb(0%,0%,0%);fill-opacity:0.839216;stroke:none;" />
                            </g>
                        </mask>
                        <clipPath id="clip16">
                            <rect x="0" y="0" width="80" height="80" />
                        </clipPath>
                        <g id="surface50" clip-path="url(#clip16)">
                            <path
                                style=" stroke:none;fill-rule:evenodd;fill:rgb(14.901961%,24.313725%,49.803922%);fill-opacity:1;"
                                d="M 69.109375 70.445312 C 70.347656 70.230469 71.234375 70.675781 71.777344 71.777344 C 70.777344 72.144531 70.703125 72.589844 71.554688 73.109375 C 72.140625 74.746094 71.621094 75.785156 70 76.222656 C 68.210938 75.84375 67.914062 75.027344 69.109375 73.777344 C 68.542969 72.667969 68.542969 71.554688 69.109375 70.445312 Z M 69.109375 70.445312 " />
                        </g>
                    </defs>
                    <g id="surface1">
                        <use xlink:href="#surface5" mask="url(#mask0)" />
                        <path
                            style=" stroke:none;fill-rule:evenodd;fill:rgb(89.411765%,85.882353%,12.941176%);fill-opacity:1;"
                            d="M 64.222656 2.445312 C 67.398438 2.351562 67.988281 3.460938 66 5.777344 C 66.222656 6.445312 66.445312 7.109375 66.667969 7.777344 C 67.742188 7.339844 68.777344 7.488281 69.777344 8.222656 C 70.386719 9.109375 70.609375 9.996094 70.445312 10.890625 C 69.914062 11.300781 69.324219 11.449219 68.667969 11.332031 C 68.78125 10.675781 68.636719 10.082031 68.222656 9.554688 C 66.835938 8.9375 65.429688 8.34375 64 7.777344 C 63.628906 7.035156 63.257812 6.296875 62.890625 5.554688 C 63.589844 4.621094 64.03125 3.582031 64.222656 2.445312 Z M 64.222656 2.445312 " />
                        <path
                            style=" stroke:none;fill-rule:evenodd;fill:rgb(90.980392%,87.058824%,11.372549%);fill-opacity:1;"
                            d="M 64.222656 9.554688 C 64.964844 9.554688 65.703125 9.554688 66.445312 9.554688 C 65.902344 12.480469 65.160156 12.480469 64.222656 9.554688 Z M 64.222656 9.554688 " />
                        <path
                            style=" stroke:none;fill-rule:evenodd;fill:rgb(91.372549%,87.45098%,10.980392%);fill-opacity:1;"
                            d="M 71.332031 13.554688 C 71.398438 12.773438 71.25 12.03125 70.890625 11.332031 C 71.628906 10.742188 72.371094 10.742188 73.109375 11.332031 C 73.378906 12.320312 73.527344 13.285156 73.554688 14.222656 C 73.320312 14.53125 73.027344 14.753906 72.667969 14.890625 C 72.382812 14.226562 71.9375 13.78125 71.332031 13.554688 Z M 71.332031 13.554688 " />
                        <path
                            style=" stroke:none;fill-rule:evenodd;fill:rgb(90.980392%,87.058824%,12.156863%);fill-opacity:1;"
                            d="M 66 12.222656 C 69.347656 12.207031 69.496094 12.949219 66.445312 14.445312 C 66.019531 13.757812 65.875 13.015625 66 12.222656 Z M 66 12.222656 " />
                        <path
                            style=" stroke:none;fill-rule:evenodd;fill:rgb(83.529412%,80.784314%,16.862745%);fill-opacity:1;"
                            d="M 69.109375 13.109375 C 69.546875 13.25 69.84375 13.546875 70 14 C 69.757812 14.90625 69.464844 15.792969 69.109375 16.667969 C 68.488281 16.503906 68.042969 16.132812 67.777344 15.554688 C 68.054688 14.628906 68.5 13.8125 69.109375 13.109375 Z M 69.109375 13.109375 " />
                        <use xlink:href="#surface8" mask="url(#mask1)" />
                        <path
                            style=" stroke:none;fill-rule:evenodd;fill:rgb(89.019608%,85.490196%,11.372549%);fill-opacity:1;"
                            d="M 62.890625 11.777344 C 63.398438 11.90625 63.695312 12.277344 63.777344 12.890625 C 63.390625 14.164062 62.652344 15.203125 61.554688 16 C 61.109375 16.296875 60.667969 16.296875 60.222656 16 C 61.789062 14.964844 62.679688 13.558594 62.890625 11.777344 Z M 62.890625 11.777344 " />
                        <use xlink:href="#surface11" mask="url(#mask2)" />
                        <path
                            style=" stroke:none;fill-rule:evenodd;fill:rgb(89.411765%,85.882353%,12.156863%);fill-opacity:1;"
                            d="M 73.554688 14.890625 C 74.117188 15.898438 74.042969 16.9375 73.332031 18 C 72.59375 18.742188 71.851562 19.480469 71.109375 20.222656 C 70.894531 19.800781 70.824219 19.355469 70.890625 18.890625 C 69.566406 18.984375 68.382812 19.429688 67.332031 20.222656 C 67.183594 20 67.035156 19.777344 66.890625 19.554688 C 68.128906 18.003906 69.757812 17.335938 71.777344 17.554688 C 72.585938 16.984375 73.179688 16.097656 73.554688 14.890625 Z M 73.554688 14.890625 " />
                        <use xlink:href="#surface14" mask="url(#mask3)" />
                        <use xlink:href="#surface17" mask="url(#mask4)" />
                        <use xlink:href="#surface20" mask="url(#mask5)" />
                        <use xlink:href="#surface23" mask="url(#mask6)" />
                        <use xlink:href="#surface26" mask="url(#mask7)" />
                        <use xlink:href="#surface29" mask="url(#mask8)" />
                        <use xlink:href="#surface32" mask="url(#mask9)" />
                        <use xlink:href="#surface35" mask="url(#mask10)" />
                        <use xlink:href="#surface38" mask="url(#mask11)" />
                        <use xlink:href="#surface41" mask="url(#mask12)" />
                        <use xlink:href="#surface44" mask="url(#mask13)" />
                        <use xlink:href="#surface47" mask="url(#mask14)" />
                        <use xlink:href="#surface50" mask="url(#mask15)" />
                    </g>
                </svg>
            </span><span style="font-family:Arial;">&nbsp;</span></p>
        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">&nbsp;</span></p>
        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">&nbsp;</span></p>
        <p class="NoSpacing" style="font-size:10pt;"><span style="font-family:Arial;">&nbsp;</span></p>
        <p class="NoSpacing" style="text-align:center; font-size:10pt;"><strong><span
                    style="font-family:Arial;">&nbsp;</span></strong></p>
        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:12pt;"><strong><span
                    style="font-family:Arial;">DTI REGION VI</span></strong></p>
        <table style="margin-bottom:0pt; border-collapse:collapse;">
            <tbody>
                <tr>
                    <td colspan="9"
                        style="width:512pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle;">
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:14pt;"><strong><span
                                    style="font-family:Arial;">PRE/POST REPAIR INSPECTION</span></strong></p>
                    </td>
                </tr>
                <tr style="height:3.2pt;">
                    <td colspan="9"
                        style="width:512pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle;">
                        <p class="NoSpacing" style="line-height:150%; font-size:1pt;"><span
                                style="font-family:Arial;">&nbsp;</span></p>
                    </td>
                </tr>
                <tr style="height:3.2pt;">
                    <td colspan="9"
                        style="width:512pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:middle;">
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:12pt;"><strong><span
                                    style="font-family:Arial;">PRE REPAIR INSPECTION</span></strong></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="width:163.25pt; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.4pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">Equipment Type</span></strong></p>
                    </td>
                    <td colspan="5"
                        style="width:163.4pt; border-bottom:0.75pt solid #000000; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">Serial No.</span></strong></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                    </td>
                    <td colspan="2"
                        style="width:163.75pt; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.4pt; vertical-align:top;">
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">End-User/Accountable Person</span></strong><br>
                            <?= $row->requested_by_name ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"
                        style="width:250.3pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt; text-align:center;"><span
                                style="font-family:Arial;"><strong>FINDINGS</strong></span></p>
                    </td>
                    <td colspan="5"
                        style="width:250.9pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt; text-align:center;"><span
                                style="font-family:Arial;"><strong>RECOMMENDATION</strong></span></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"
                        style="width:250.3pt; height:200.3pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <?= $row->diagnosis ?>
                    </td>
                    <td colspan="5"
                        style="width:250.9pt; height:200.9pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <?= $row->remarks ?>
                    </td>
                </tr>
                <tr>
                    <td
                        style="width:120.35pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:bottom;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">Requested by:</span></strong></p>
                    </td>
                    <td colspan="3"
                        style="width:119.15pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:bottom;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">Reviewed by:</span></strong></p>
                    </td>
                    <td colspan="4"
                        style="width:119.15pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:bottom;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">Inspected by:</span></strong></p>
                    </td>
                    <td
                        style="width:120.95pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:bottom;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">Approved by:</span></strong></p>
                    </td>
                </tr>
                <tr>
                    <td
                        style="width:120.35pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><span
                                style="font-family:Arial;">&nbsp;</span></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><span style="font-family:Arial;">
                                <?= $row->requested_by_name ?>
                            </span></p>
                    </td>
                    <td colspan="3"
                        style="width:119.15pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><span
                                style="font-family:Arial;">&nbsp;</span></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><span
                                style="font-family:Arial;">Ma. Kristine Rosaldes</span></p>
                    </td>
                    <td colspan="4"
                        style="width:119.15pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><span
                                style="font-family:Arial;">&nbsp;</span></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><span
                                style="font-family:Arial;">Angelo Patrimonio</span></p>
                    </td>
                    <td
                        style="width:120.95pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><span
                                style="font-family:Arial;">&nbsp;</span></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><span
                                style="font-family:Arial;">&nbsp;</span></p>
                    </td>
                </tr>
                <tr>
                    <td
                        style="width:120.35pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:bottom;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt; text-align: center;"><em><span
                                    style="font-family:Arial;">End-User</span></em></p>
                    </td>
                    <td colspan="3"
                        style="width:119.15pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:bottom;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt; text-align: center;"><em><span
                                    style="font-family:Arial;">Property</span></em></p>
                    </td>
                    <td colspan="4"
                        style="width:119.15pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:bottom;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt; text-align: center;"><em><span
                                    style="font-family:Arial;">Technical Inspector</span></em></p>
                    </td>
                    <td
                        style="width:120.95pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:bottom;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt; text-align: center;"><em><span
                                    style="font-family:Arial;">&nbsp;</span></em></p>
                    </td>
                </tr>
                <tr>
                    <td
                        style="width:120.35pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">Date:</span></strong></p>
                    </td>
                    <td colspan="3"
                        style="width:119.15pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">Date:</span></strong></p>
                    </td>
                    <td colspan="4"
                        style="width:119.15pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">Date:</span></strong></p>
                    </td>
                    <td
                        style="width:120.95pt; border:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">Date:</span></strong></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="9"
                        style="width:512pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:12pt;"><strong><span
                                    style="font-family:Arial;">C E R T I F I C A T I O N</span></strong></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="9"
                        style="width:512pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><span
                                style="font-family:Arial;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
                                style="font-family:Arial;">As end-user/accountable person for the above equipment, I
                                certify that the Repair/Work/ Replacement of parts done were satisfactorily completed
                                and I hereby accept term, subject to post-repair inspection</span></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"
                        style="width:250.6pt; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.4pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:8pt;"><span
                                style="font-family:Arial;">___________________________</span></p>
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">Date</span></strong></p>
                    </td>
                    <td colspan="4"
                        style="width:250.6pt; border-right:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.4pt; vertical-align:top;">
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;</span></strong></p>
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:8pt;"><span
                                style="font-family:Arial;"><u>&emsp;&emsp;&emsp;
                                    <?= $row->requested_by_name ?>&emsp;&emsp;&emsp;
                                </u></span></p>
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">End-User/Accountable Person</span></strong></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="9"
                        style="width:512pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:12pt;"><strong><span
                                    style="font-family:Arial;">POST REPAIR INSPECTION</span></strong></p>
                    </td>
                </tr>
                <tr style="height:6.4pt;">
                    <td colspan="3"
                        style="width:198.3pt; border-left:0.75pt solid #000000; padding-right:5.4pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><span
                                style="font-family:Arial;">Invoice No.</span><span
                                style="font-family:Arial;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
                                style="font-family:Arial;">______________________</span></p>
                    </td>
                    <td colspan="3" style="width:93.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><span
                                style="font-family:Arial;">Date: ____________</span></p>
                    </td>
                    <td colspan="3"
                        style="width:198.35pt; border-right:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.4pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><span
                                style="font-family:Arial;">Amount: ____________</span></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"
                        style="width:198.3pt; border-left:0.75pt solid #000000; padding-right:5.4pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><span
                                style="font-family:Arial;">Work Order No. ______________________</span></p>
                    </td>
                    <td colspan="3" style="width:93.75pt; padding-right:5.4pt; padding-left:5.4pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><span
                                style="font-family:Arial;">Date: ____________</span></p>
                    </td>
                    <td colspan="3"
                        style="width:198.35pt; border-right:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.4pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><span
                                style="font-family:Arial;">Amount: ____________</span></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="9"
                        style="width:512pt; border-right:0.75pt solid #000000; border-left:0.75pt solid #000000; border-bottom:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:8pt;"><strong><span
                                    style="font-family:Arial;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong><span
                                style="font-family:Arial;">Inspected and found that the repair/work done/replacement
                                of parts were satisfactorily completed in accordance with the specification and that
                                the same is duly accepted by the</span><strong><span
                                    style="font-family:Arial;">&nbsp;&nbsp;&nbsp;</span></strong><span
                                style="font-family:Arial;">end-user/accountable person.</span></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"
                        style="width:250.6pt; border-top:0.75pt solid #000000; border-left:0.75pt solid #000000; padding-right:5.4pt; padding-left:5.03pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">Inspected by:</span></strong></p>
                    </td>
                    <td colspan="4"
                        style="width:250.6pt; border-top:0.75pt solid #000000; border-right:0.75pt solid #000000; padding-right:5.03pt; padding-left:5.4pt; vertical-align:top;">
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><strong><span
                                    style="font-family:Arial;">Noted:</span></strong></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="5"
                        style="width:250.6pt; border-left:0.75pt solid #000000; border-bottom:0 solid #000000; padding-right:5.4pt; padding-left:5.03pt; vertical-align:top;">
                        <br><br>
                        <p class="NoSpacing"
                            style="text-align:center; line-height:150%; border-bottom:0.75pt solid #000000; padding-bottom:1pt; font-size:10pt;">
                            <span style="font-family:Arial;"><strong>Angelo Patrimonio</strong></span>
                        </p>
                        <p class="NoSpacing" style="text-align:center; line-height:150%; font-size:10pt;"><em><span
                                    style="font-family:Arial;">Technical Inspector</span></em></p>
                    </td>
                    <td colspan="4"
                        style="width:250.6pt; border-right:0.75pt solid #000000; border-bottom:0 solid #000000; padding-right:5.03pt; padding-left:5.4pt; vertical-align:top;">
                        <br><br>
                        <p class="NoSpacing"
                            style="line-height:150%; border-bottom:0.75pt solid #000000; padding-bottom:1pt; font-size:10pt;">
                            <span style="font-family:Arial;">&nbsp;</span>
                        </p>
                        <p class="NoSpacing" style="line-height:150%; font-size:10pt;"><span
                                style="font-family:Arial;">&nbsp;</span></p>
                    </td>
                </tr>
                <tr style="height:0pt;">
                    <td style="width:131.15pt;"><br></td>
                    <td style="width:42.9pt;"><br></td>
                    <td style="width:35.05pt;"><br></td>
                    <td style="width:52pt;"><br></td>
                    <td style="width:0.3pt;"><br></td>
                    <td style="width:52.25pt;"><br></td>
                    <td style="width:34.6pt;"><br></td>
                    <td style="width:42.8pt;"><br></td>
                    <td style="width:131.75pt;"><br></td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="NoSpacing" style="font-size:5pt; margin-top:10px;"><span style="font-family:Arial;">System generated: DTI6
            MIS</span></p>
</body>

</html>