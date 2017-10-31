function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function getYears(){
    return $.ajax({
        url: '/admin/commissions/getYears'
    });
}

function getMonths($val){
    return $.ajax({
        url: '/admin/commissions/getMonths/'+$val
    });
}

function monthChange($chef,$yearType,$type){
    return $.ajax({
        url: '/admin/commissions/monthChange/' + $chef +'/'+ $yearType +'/'+ $type
    });
}
// function typeChange($chef,$type,$monthType){
//     return $.ajax({
//         url: '/admin/commissions/monthChange/' + $chef +'/'+ $type +'/'+ $monthType
//     });
// }