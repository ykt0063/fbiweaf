<script>
function memberEP(tag)
{
	var endr='\r\n';
	var beginFont='';
	var endFont='';
	if (!tag){
		endr="<br>";
		beginFont="<font style='font-size:16pt'>";
		endFont='</font>';
	}
	var str=beginFont+"購物金之說明"+endFont+endr;
	str=str+endr;
	str=str+"購物金並非現金，是成泰生物科技有限公司(以下簡稱本公司)回饋給會員朋友超值優惠，您僅可以使用購物金於本公司網站購物時折抵商品。"+endr;
	str=str+endr;
	str=str+"購物金是什麼？"+endr;
	str=str+endr;
	str=str+"購物金是本公司官網上會員回饋系統，在本公司官網上消費時使用，1點購物金可抵扣新台幣1元。"+endr;
	str=str+endr;
	str=str+"如何獲得購物金？"+endr;
	str=str+endr;
	str=str+"1.會員加入即可獲得300元購物金"+endr;
	str=str+"2.會員可於生日當月之首日，獲得生日購物金300點"+endr;
	str=str+"3.分享好友並協助其成功成為會員時，每名可獲得300元購物金"+endr;
	str=str+endr;
	str=str+"購物金使用注意事項"+endr;
	str=str+endr;
	str=str+"購物金使用抵扣上限:訂單結帳時，您可自行選擇是否使用部分購物金抵用。運費金額不可使用購物點數折抵。未出貨的訂單取消，購物金、自動退回您的會員帳戶中，可重新登入查詢，若出貨中以後辦理退貨，購物金、則無法保留。購物金是給會員一種折價憑證，可在本公司官網範圍及條件下使用，在網站進行購物活動時獲得特定之折價優惠，並非當然等同現金，亦非會員之資產，會員不可將其以任何形式轉讓予他人。購物金不構成交易對價，亦不可轉換成現金。任何經由輸入正確帳號與密碼抵用購物金點數之行為，均視為該會員之行為。因不可歸責於本公司官網上或因不可抗力之因素導致購物金資料流失時，成泰生物科技有限公司網站不負賠償或補償之責。本公司官網上保留隨時變更、修改或終止本活動及約定條款之權利，若有異動，修改後的活動內容及約定條款將公佈在本公司官網上，若您於任何修改或變更後繼續使用本服務時，視為您已閱讀、瞭解並同意接受該等修改或變更。因本活動所生之一切爭議以中華民國法令為準據法，並以台灣台北地方法院為第一審管轄法院。網站加入會員送300購物金機制為優惠回饋活動，每人限領一次，若發現有多次創立帳號濫用之情況，成泰生物科技有限公司網站有權收回購物金並刪除濫用帳號。"+endr;
	str=str+endr;
	str=str+"如何查詢自己有多少購物金？"+endr;
	str=str+endr;
	str=str+"購物金發放時，您也可以於網站上方的【我的帳戶】內直接查看自己還有多少購物金可以使用。"+endr;
	if (!tag){
		document.getElementById("idForMemberEP").innerHTML = str;
	}
	else{
		return confirm(str);
	}
}
</script>

