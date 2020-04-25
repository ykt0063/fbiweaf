var Banner = {
	bannerShowTarget:null,
	bannerList:[],
	nowBanner:0,
	timer:null,
	sec:0,
	bannerChangeSec:5,
	initTimer:function()
	{
		Banner.stopTimer();
		Banner.changeBanner();
		//start
		Banner.timer = setInterval(function(){
			Banner.countTimer();
		}, 1000);
	},
	stopTimer:function()
	{
		if(Banner.timer != null){
			clearInterval(Banner.timer);
		}

		Banner.timer = null;
	},
	countTimer:function()
	{
		Banner.sec++;

		if((Banner.sec % Banner.bannerChangeSec) == 0){
			Banner.changeBanner();
		}
	},
	changeBanner:function()
	{
		if(Banner.bannerShowTarget == null){
			return;
		}
		
		var html = '',obj;
		if(Banner.nowBanner in Banner.bannerList){
			obj = Banner.bannerList[Banner.nowBanner];
			html = '<img src="'+obj['image']+'" alt="">';
			if(obj['url'] != ''){
				html = '<a href="'+obj['url']+'" target="_blank">'+html+'</a>';
			}
			
			Banner.bannerShowTarget.html(html);
			Banner.nowBanner ++;
		}
		
		if(Banner.nowBanner >= Banner.bannerList.length){
			Banner.nowBanner = 0;
		}
	}
};
