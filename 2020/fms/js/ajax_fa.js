function fa_callAJAX(str, index, target) {
    str2 = str;
    var http_request = false;
    if (window.XMLHttpRequest) { // Mozilla, Safari,...
	    http_request = new XMLHttpRequest();
    } else if (window.ActiveXObject) { // IE
	    try {
		    http_request = new ActiveXObject("Msxml2.XMLHTTP");
	    } catch (e) {
		    try {
		    http_request = new ActiveXObject("Microsoft.XMLHTTP");
		    } catch (e) {}
	    }
    }
    if (!http_request) {
	    alert('Giving up :( Cannot create an XMLHTTP instance');
	    return false;
    }
	http_request.onreadystatechange = function () { fa_getResult(http_request, index, target); };
    http_request.open('POST', 'Scripts/AJAX_FA.aspx', true);
    var urlStr = 'method=' + index;
        switch(index) {
            case 2:
                urlStr += '&category=' + encodeURIComponent(document.getElementById('sCategory').value);
                urlStr += '&fano=' + encodeURIComponent(document.getElementById('sFANo').value);
                urlStr += '&username=' + encodeURIComponent(document.getElementById('sUsername').value);
                urlStr += '&partname=' + encodeURIComponent(document.getElementById('sPartname').value);
                urlStr += '&remark=' + encodeURIComponent(document.getElementById('sRemark').value);
                urlStr += '&status=' + encodeURIComponent(document.getElementById('sStatus').value);
                urlStr += '&orderby=' + encodeURIComponent(document.getElementById('sOrderBy').value);
                urlStr += '&enterdate1=' + encodeURIComponent(document.getElementById('sEnterDate1').value);
                urlStr += '&enterdate2=' + encodeURIComponent(document.getElementById('sEnterDate2').value);
                urlStr += '&transferdate1=' + encodeURIComponent(document.getElementById('sTransferDate1').value);
                urlStr += '&transferdate2=' + encodeURIComponent(document.getElementById('sTransferDate2').value);
                urlStr += '&direction=' + encodeURIComponent(document.getElementById('sDirection').value);
                urlStr += '&excel=' + $('input[name="excel"]:checkbox:checked').map(function () { return $(this).val(); }).get().join(',');
                break;
            case 4:
            case 21:
                urlStr += '&num=' + $('input[name="cbox"]:checkbox:checked').map(function () { return $(this).val(); }).get().join(',');
                break;
            case 6:
            case 8:
           // case 58:
                urlStr += '&num=' + str;
                urlStr += '&category=' + encodeURIComponent(document.getElementById('iCategory' + str).value);
                urlStr += '&fano=' + encodeURIComponent(document.getElementById('iFANo' + str).value);
                urlStr += '&partid=' + encodeURIComponent(document.getElementById('iPartID' + str).value);
                urlStr += '&serial=' + encodeURIComponent(document.getElementById('iSerial' + str).value);
                urlStr += '&enterdate=' + encodeURIComponent(document.getElementById('iEnterDate' + str).value);
                urlStr += '&transferdate=' + encodeURIComponent(document.getElementById('iTransferDate' + str).value);
                urlStr += '&username=' + encodeURIComponent(document.getElementById('iUsername' + str).value);
                urlStr += '&dept=' + encodeURIComponent(document.getElementById('iDept' + str).value);
                urlStr += '&unitprice=' + encodeURIComponent(document.getElementById('iUP' + str).value);
                urlStr += '&remark=' + encodeURIComponent(document.getElementById('iRemark' + str).value);
                urlStr += '&status=' + encodeURIComponent(document.getElementById('iStatus' + str).value);
                urlStr += '&vendor=' + encodeURIComponent(document.getElementById('iVendor' + str).value);
                urlStr += '&ma=' + encodeURIComponent(document.getElementById('iMA' + str).value);
                urlStr += '&locationid=' + encodeURIComponent(document.getElementById('iLocation' + str).value);
                break;
            case 10:
                urlStr += '&num=' + str;
                urlStr += '&category=' + document.getElementById('iCategory' + str).value
                urlStr += '&target=' + target;
                break;
            case 12:
                urlStr += '&category=' + encodeURIComponent(document.getElementById('sCategory').value);
                urlStr += '&dept=' + encodeURIComponent(document.getElementById('sDept').value);
                urlStr += '&subject=' + encodeURIComponent(document.getElementById('sSubject').value);
                urlStr += '&date1=' + encodeURIComponent(document.getElementById('sDate1').value);
                urlStr += '&date2=' + encodeURIComponent(document.getElementById('sDate2').value);
                urlStr += '&orderby=' + encodeURIComponent(document.getElementById('sOrderBy').value);
                urlStr += '&direction=' + encodeURIComponent(document.getElementById('sDirection').value);
                break;
            case 15:
                urlStr += '&num=' + str;
                urlStr += '&category=' + encodeURIComponent(document.getElementById('category' + str).value);
                urlStr += '&dept=' + encodeURIComponent(document.getElementById('dept' + str).value);
                urlStr += '&subject=' + encodeURIComponent(document.getElementById('subject' + str).value);
                urlStr += '&remark=' + encodeURIComponent(document.getElementById('remark' + str).value);
                urlStr += '&date1=' + encodeURIComponent(document.getElementById('date1_' + str).value);
                urlStr += '&estcomplete=' + encodeURIComponent(document.getElementById('estcomplete' + str).value);
                urlStr += '&weight=' + encodeURIComponent(document.getElementById('weight' + str).value);
                urlStr += '&status=' + encodeURIComponent(document.getElementById('status' + str).value);
                break;
            case 55:
                urlStr += '&category=' + encodeURIComponent(document.getElementById('iCategory').value);
                urlStr += '&location=' + encodeURIComponent(document.getElementById('iLocation').value);
                urlStr += '&barcode=' + encodeURIComponent(document.getElementById('iBarCode').value);
                break;
            case 62:
            case 64:
                urlStr += '&isDevice=' + str;
                urlStr += '&parentID=' + $("#jstree").jstree().get_selected(true)[0].id;
                break;
            case 65:
                urlStr += '&node_id=' + str;
                urlStr += '&node_parent=' + target;
                break;
            case 67:
            case 69:
                urlStr += '&node_text=' + str;
                urlStr += '&node_id=' + $("#jstree").jstree().get_selected(true)[0].id;
                break;
             case 72: 
                urlStr += '&key=' + encodeURIComponent(document.getElementById('sKey').value);
                urlStr += '&orderby=' + encodeURIComponent(document.getElementById('sOrderBy').value);
                urlStr += '&direction=' + encodeURIComponent(document.getElementById('sDirection').value);
                break;
            case 73:
            case 74:
                urlStr += '&num=' + str;
                urlStr += '&userid=' + encodeURIComponent(document.getElementById('iUser' + str).value);
                urlStr += '&locationid=' + encodeURIComponent(document.getElementById('iLocationID' + str).value);
                urlStr += '&enable=' + encodeURIComponent(document.getElementById('iEnable' + str).value);
                break;
            case 78:
                urlStr += '&num=' + str;
                urlStr += '&category=' + encodeURIComponent(document.getElementById('iCategory' + str).value);
                urlStr += '&fano=' + encodeURIComponent(document.getElementById('iFANo' + str).value);
                urlStr += '&partid=' + encodeURIComponent(document.getElementById('iPartID' + str).value);
                urlStr += '&serial=' + encodeURIComponent(document.getElementById('iSerial' + str).value);
                urlStr += '&enterdate=' + encodeURIComponent(document.getElementById('iEnterDate' + str).value);
                urlStr += '&transferdate=' + encodeURIComponent(document.getElementById('iTransferDate' + str).value);
                urlStr += '&username=' + encodeURIComponent(document.getElementById('iUsername' + str).value);
                urlStr += '&dept=' + encodeURIComponent(document.getElementById('iDept' + str).value);
                urlStr += '&unitprice=' + encodeURIComponent(document.getElementById('iUP' + str).value);
                urlStr += '&remark=' + encodeURIComponent(document.getElementById('iRemark' + str).value);
                urlStr += '&status=' + encodeURIComponent(document.getElementById('iStatus' + str).value);
                urlStr += '&vendor=' + encodeURIComponent(document.getElementById('iVendor' + str).value);
                urlStr += '&ma=' + encodeURIComponent(document.getElementById('iMA' + str).value);
                urlStr += '&locationid=' + encodeURIComponent(document.getElementById('iLocation' + str).value);
                break;
            case 94:
                urlStr += '&num=' + str;
                urlStr += '&seq=' + encodeURIComponent(document.getElementById('iSeq' + str).value);
                urlStr += '&target=' + target;
                break;
            default:    // 1  3  6  7   9  10, 11 13 14 16, 22, 23, 31, 51, 56, 57, 59, 61, 62, 66, 71, 75, 79, 82, 91, 92
                urlStr += '&num=' + str;
                urlStr += '&target=' + target;
                break;
        }
    http_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    http_request.send(urlStr);
}

function fa_getResult(http_request, index, target) {
	if (http_request.readyState == 4) {
	    if (http_request.status == 200) {
	        var txt = http_request.responseText;
	        switch (index) {
	            case 3: // new
                case 13: // new
	                if (txt != '')
	                    alert(txt);
	                else
	                    fa_callAJAX('', index-1, 'erp_search');
	                break;
                case 2:
	                if (txt != '') {
                        if (txt.indexOf("/ERP/Main") == 0)
	                        $(location).attr('href', txt);
	                    else
	                        animationFadeIn(target, txt);
	                }
	                else
	                    document.getElementById(target).innerHTML = '';
                    break;
                case 6:
                    if (txt != '')
                        animationFadeIn(target, txt);
                    else
                        fa_callAJAX('', 4, 'erp_modal');
                    break;
                case 7:
                    fa_callAJAX('', 4, 'erp_modal');
                    break;
	            case 14: // edit
	                if (txt != '') {
	                    document.getElementById('openWin2').style.left = "80px";
	                    document.getElementById('openWin2').style.top = "80px";
	                    $('#openWin2').width(win_width);
	                    $('#openWin2').height(win_height);
	                    animationFadeIn('openWin2', txt);
	                    $("#openWin2").draggable();
	                }
	                break; 
	            case 15: // update
	                if (txt != '')
	                    alert(txt);
	                else
	                    fa_callAJAX(str2, index - 1, 'erp_search');
	                break;
	            case 16: // DISABLE
	                if (txt != '')
	                    alert(txt);
	                else {
	                    fa_callAJAX('', 12, 'erp_search');
	                }
	                break;
	            case 21:
	                if (txt != '')
	                    window.open(txt, '_smprint', '', '');
	                break;
	            case 22:
                case 23:
                case 24:
                case 25:
                case 63:
	                if (txt != '') {
	                    document.getElementById('openWin3').style.left = mouseX - 60 + "px";
	                    document.getElementById('openWin3').style.top = mouseY - 67 + "px";
	                    $('#openWin3').width(win_width);
	                    $('#openWin3').height(win_height);
	                    animationFadeIn('openWin3', txt);
	                }
                    break;
                case 32:
                    if (txt == '') {
                        $("#myModal").modal('toggle');
                        alert('Imported Success !');
                    }
                    else
                        animationFadeIn(target, txt);
                    break;
                case 61:
                    if (txt != '') {
                        //alert(txt);
                        animationFadeIn(target, "<div id=\"jstree\"></div>");
                        $('#jstree').jstree({
                            'core': {
                                'data': JSON.parse(txt).data,
                                'check_callback': true,
                                'multiple': false,
                                "expand_selected_onload": false
                            },
                            'dnd': {
                                'is_draggable': function (node) {
                                    if (node[0].li_attr['description'] == 'root')
                                        return false;
                                    else
                                        return true;
                                }
                            },
                            'plugins': ["dnd", "types", "contextmenu"],
                            'contextmenu': { "items": customMenu }
                        }).on('loaded.jstree', function () {
                            //$('#jstree').jstree('open_all');
                        })
                            .on('contextmenu', function () {
                                return false;
                            })
                            .bind("move_node.jstree", function (e, data) {
                                if (data.parent == '#') {
                                    alert('根目錄禁止操作');
                                    fa_callAJAX('', 61, 'erp_top');
                                    return false;
                                }
                                fa_callAJAX(data.node.id, 65, data.parent);
                            })
                            .bind("rename_node.jstree", function (node, data) {
                                fa_callAJAX(data.text, 69, '');
                                return false;
                            })
                            .bind("copy_node.jstree", function (e, data) {
                                if (data.parent == '#') {
                                    alert('根目錄禁止操作');
                                    fa_callAJAX('', 61, 'erp_top');
                                    return false;
                                }
                                fa_callAJAX(data.original.id, 70, data.parent);
                            })
                            .on('hover_node.jstree', function (e, data) {
                                if (data.node.a_attr['fano'] != '')
                                    $("#" + data.node.id).prop('title', data.node.a_attr['fano']);
                            });
                    }
                    break;
                case 62:
                    if (txt != '') {
                        $('#jstree').jstree('create_node', $('#jstree').jstree('get_selected'), JSON.parse(txt).data, "first", false, false);
                    }
                    break;
                case 64:
                    if (txt != '')
                        alert(txt);
                    else
                        $("#jstree").jstree('delete_node', $("#" + $("#jstree").jstree().get_selected(true)[0].id));
                    break;
                case 65:
                    if (txt != '') {
                        alert(txt);
                        fa_callAJAX('', 61, 'erp_top');
                    }
                    break;
                case 69:
                    if (txt != '')
                        alert(txt);
                    break;
                case 67:
                    if (txt != '')
                        alert(txt);
                    else
                        $("#jstree").jstree('rename_node', $('#jstree').jstree('get_selected'), str2);
                    break;
                case 70:
                    if (txt != '')
                        alert(txt);
                    else
                        fa_callAJAX('', 61, 'erp_top');
                    break;
                case 71:
                    if (txt != '') {
                        animationFadeIn(target, txt);
                        fa_callAJAX('', 72, 'erp_search');
                    }
                    else
                        document.getElementById(target).innerHTML = '';
                    break;
                case 73:
                case 74:
                case 75:
                    if (txt != '')
                        alert(txt);
                    else
                        fa_callAJAX('', 72, 'erp_search');
                    break;
                case 77:
                    if (txt != '')
                        $('#jstree').jstree('refresh_node', JSON.parse(txt).data);
                    break;
                case 78:
                    if (txt != '') {
                        close_openWin3();
                        // 更新編輯畫面
                        //fa_callAJAX($("#jstree").jstree().get_selected(true)[0].id, 66, 'tabs_FA');
                        fa_callAJAX(str2, 82, '');
                        fms_callAJAX($("#jstree").jstree().get_selected(true)[0].id, 41, 'erp_modal');
                        //fa_callAJAX(str2, 82, '');
                        //$("#jstree").jstree('rename_node', $('#jstree').jstree('get_selected'), txt);
                    }
                    break;
                case 79: // update fa.locationid        //
                case 80:
                    if (txt != '')
                        alert(txt);
                    else
                        fa_callAJAX('', 4, 'erp_modal');
                    break;
                case 81:
                    if (txt != '')
                        alert(txt);
                    else {
                        fa_callAJAX($("#jstree").jstree().get_selected(true)[0].id, 66, 'tabs_FA');
                        fa_callAJAX('', 61, 'erp_top');
                    }
                    break;
                case 82:
                    if (txt != '')
                        $("#jstree").jstree('rename_node', $('#jstree').jstree('get_selected'), txt);
                    break;
	            default:    //      1  2, 4,  5, 7, 8, 9, 10, 11, 12, 31, 51, 53, 54, 55, 57, 58, 59, 62, 66, 72
                    if (txt != '') {
                        animationFadeIn(target, txt);
                        if (target == 'erp_modal')
                            $("#myModal").modal({ backdrop: 'static', keyboard: false });
                    }
	                else
	                    document.getElementById(target).innerHTML = '';
	                break;
	        }
	    }
	    else {
	        close_div();
	        alert('There was a problem with the request, index=' + index);
	    }
	}
}


function testnode() {
    alert('test creating node');
    createNode("#node_8", "sub_3", "Sub 3", "last");
}

function createNode(parent_node, new_node_id, new_node_text, position) {
    $('#jstree').jstree('create_node', $(parent_node), { "text": new_node_text, "id": new_node_id }, position, false, false);
}



