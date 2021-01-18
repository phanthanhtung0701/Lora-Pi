
const PosEnum =
    ["Trần Duy Hưng", "Lê Trọng Tấn", "Giảng Võ",
        "Giải Phóng", "Yên Lãng", "Trần Đại Nghĩa", "Tạ Quang Bửu"];

let nodeData = []
function loadAjax()
{
    $.ajax({
        url: "api/getAllNode",
        type: "post",
        data: {} ,
        success: function (response) {
            for (let i = 0; i < response.length; i++) {
                let node = response[i];
                let id = node["id"];
                let _status = "OFF";
                let _pos = node['position'];
                $("#po-"+id).text(PosEnum[_pos]);
                let back_color = 'white'
                switch (node['status']) {
                    case 1:
                        _status = "ON";
                        back_color = '#ADD8E6';
                        break;
                    case 0:
                        _status = "OFF";
                        back_color = 'lightGrey';
                        break;
                    default:
                        _status = "OFF";
                        back_color = 'yellow';
                }

                $("#node-"+id).css('background-color',back_color);
                $("#st-"+id).text(_status);

                // if (!(id in nodeData)) {
                    nodeData[id] = [node['position'], node['status']];
                // }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}

let ids = [15306, 15307, 15308, 15309];
// e_TranDuyHung = 0x00,
//     e_LeTrongTan = 0x01,
//     e_GiangVo = 0x02,
//     e_GiaiPhong = 0x03,
//     e_YenLang = 0x04,
//     e_DuongLang = 0x05,
//     e_DaiLa = 0x06,
//     e_DaiCoViet = 0x07,
//     e_TranDaiNghia = 0x08,
//     e_TaQuangBuu = 0x09,
//     e_BachMai = 0x0A,
//     e_Unused = 0xFF,


loadAjax();
setInterval( loadAjax, 10000);

function sendAction(id, value)
{
    $.ajax({
        url: "api/sendAction",
        type: "post",
        data: {'id': id, 'action': value} ,
        success: function (response) {
            console.log(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}


for (let i=0; i<ids.length; i++) {
    let id = ids[i];

    $("#start-"+id).click(function () {
        if (nodeData[id][1] !== 1) {
            let res = sendAction(id, 1);
        }
        else alert("Đèn đã được bật rồi!!!");

        // $("#start-"+id).addClass("btn-clicked");
    });


    $("#stop-"+id).click(function () {
        if (nodeData[id][1] !== 0) {
            let res = sendAction(id, 0);
        }
        else alert("Đèn đã được tắt rồi!!!");
    });
}


$("#start").click(function () {
    let startNodes = []
    for (let i=0; i<ids.length; i++) {
        let id = ids[i];
        if (nodeData[id][1] !== 1) {
            startNodes.push(id);
        }
    }

    if (startNodes.length>0) {
        for (let i=0; i<startNodes.length; i++) {
            sendAction(startNodes[i], 1);
        }
    } else alert("Tất cả đèn đã được bật rồi!!!");
});


$("#stop").click(function () {
    let stopNodes = []
    for (let i=0; i<ids.length; i++) {
        let id = ids[i];
        if (nodeData[id][1] !== 0) {
            stopNodes.push(id);
        }
    }

    if (stopNodes.length>0) {
        for (let i=0; i<stopNodes.length; i++) {
            sendAction(stopNodes[i], 0);
        }
    } else alert("Tất cả đèn đã được bật rồi!!!");
});
