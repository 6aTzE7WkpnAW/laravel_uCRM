const nl2br = (str) => {
    var res = str.replace(/\r\n/g,"<br>");
    res = res.replace(/(\n|\r)/g,"<br>");
    return res;
}

const getToday = () => {  // アロー関数は () => { }
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = ("0"+(today.getMonth()+1)).slice(-2);  // = を追加
    const dd = ("0"+today.getDate()).slice(-2);       // = を追加
    return yyyy+'-'+mm+'-'+dd;
}

export { nl2br, getToday }  // getTodey → getToday (スペルミス修正)