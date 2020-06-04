# wkj_api
                                               玩客家交易api文档说明
本api加密所需的key请于玩客家（www.wkj.link)安全中心申请并保存。                                               
1：错误代码说明：
     
      代码	描述
      1001	当前市场禁止交易
      1002	交易价格格式错误
      1003	交易数量格式错误
      1004	交易市场错误
      1005	交易数量错误
      1006	交易类型格式错误
      1007	交易价格超过最大限制
      1008	Bitcny余额不足
      1009	币余额不足
      1010	接口维护中
      1011	access_key error or expiry failure
      1012	市场不存在
      1013	方法不存在
      1014	access_key错误或失效。请重新申请
      1015	已经超出了限制次数,60秒后再试
      1016  data error
	  1017  参数错误
	  1018  data is null
    host:app.wkj.link
2：接口说明：请求方式为post.返回json数据
     
     (1)	委托交易api:
             url: app.wkj.link/order/upTrade
      参数说明：
            参数名	描述
            access_key	Access_key
            method	当前方法名称(upTrade)
            market	市场名称
            price	  价格(不超过当前设定小数位默认4)
            num	    数量
            type	  下单类型：1买，2卖
            sign	  签名(加密方式详情见demo)
            reqTime	毫秒时间戳
      响应数据：
     
        {
          "id" : "15393469943186B7n0aQ12"
          "code" : 200
        }

     (2)	撤销交易api:
      url: app.wkj.link/order/Cancel
      参数说明：
          参数名	      描述
          access_key	Access_key
          method	    当前方法名称(Cancel)
          market	    市场名称
          trade_num	  委托订单号
          sign	      签名(加密方式详情见demo)
          reqTime	    毫秒时间戳
     返回值：
      {
          "code" : 200
          "msg"  : '撤销成功'
      }

    (3)	刷单接口api:
    url: app.wkj.link/order/upOrder

      参数名	      描述
      access_key	Access_key
      method	    当前方法名称(upTrade)
      market	    市场名称
      price	      价格(买一价与卖一价之间)
      type	      下单类型：(1先卖后买，2先买后卖)
      num	        下单数量
      sign	      签名(加密方式详情见demo)
      reqTime	    毫秒时间戳

      返回值说明：
      
      {
          "code" : 200
          "msg" : "ok"
      }
      (4)	订单状态api
       url: app.wkj.link/order/getTradeStatus
          参数名	     描述
          access_key	Access_key
          method	    当前方法名称(getTradeStatus)
          market	    市场名称(如:wkb_bitcny)
          trade_num	  交易订单号
          sign	      签名(加密方式详情见demo)
          reqTime	    毫秒时间戳
          响应数据：
         {
              [market] => wkb_cny
              [price] => 2.34800000
              [trade_number] => 15374330818732Ttnrp1
              [total] => 28.24734000
              [trade_amount] => 28.24734000
              [status] => 1
              [type] => 1
              [addtime] => 1537433081
          }
          参数名	        描述
          market	      市场名称
          price	        价格
          trade_number	交易订单号
          total	        下单总量
          trade_amount	已交易数量
          status	1:交易已完成；0:交易未完成
          type	        1:buy;2:sell
          addtime	下单时间

          (5)	查询币种余额
            url:app.wkj.link/order/getBalance
              请求参数
              参数名	       描述
              access_key	access_key
              method	    当前方法名称(getBalance)
              coin	        币种名称(如:wkb)
              sign	        签名(加密方式详情见demo)
              reqTime	    毫秒时间戳
              请求结果：
              {
				"coin":"eos",
				"balance":"370.68951214",  //余额
				"balanced":"380.24933786"  //冻结余额
	      }
         (6)查询市场的所有挂单（三天内）
            url:app.wkj.link/order/getOrderStatus 
            请求参数
            参数名	        描述
            access_key	  access_key
            method	      当前方法名称(getOrderStatus)
            market	      市场名称
            status	      订单状态(0:未完成;1:已完成;2已撤销;3:返回全部)
            sign	      签名(加密方式详情见demo)
            reqTime	      毫秒时间戳
            请求结果：
            {
				"code":200,
				"msg":[
					{
						"price":"2.16000000",
						"total":"1.00000000",
						"trade_amount":"0.00000000",
						"trade_num":"1543816715003AD2aUC1",
						"type":"2",
						"status":"0",
						"addtime":""
					},
					{
						"price":"1.81000000",
						"total":"1.00000000",
						"trade_amount":"0.20000000",
						"trade_num":"1543816733115pktJeH1",
						"type":"1",
						"status":"0",
						"addtime":""
					}
				]
			}
            参数名	    描述
	    price	        价格
	    total	        下单总量
            trade_amount	已交易数量
            trade_num	        交易订单号
            type	        交易类型(1:买;2:卖)
            status	        订单状态(0:未完成;1:已完成)
	    addtime             订单创建时间
		(7)分页获取市场的所有挂单（三天内）
            url:app.wkj.link/order/getOrderStatusByPage 
            请求参数
            参数名	        描述
            access_key	  access_key
            method	      当前方法名称(getOrderStatusByPage)
            market	      市场名称
            status	      订单状态(0:未完成;1:已完成;2:已撤销;3:返回全部)
			page          页码(可选,默认为1)
			limit         单页返回条数(可选:默认为50,最大100)
            sign	      签名(加密方式详情见demo)
            reqTime	      毫秒时间戳
            请求结果：
            {
				"code": 200,
				"data": {
					"page": "1",
					"total": "78",
					"pages": 39,
					"msg": [
						{
							"price": "0.82000000",
							"total": "0.01000000",
							"trade_amount": "0.00000000",
							"trade_num": "1560416577189tZ2eW91",
							"type": "2",
							"status": "0",
							"addtime": "1560416577"
						},
						{
							"price": "0.82000000",
							"total": "0.01000000",
							"trade_amount": "0.00000000",
							"trade_num": "1560416576255uazLDo1",
							"type": "2",
							"status": "0",
							"addtime": "1560416576"
						}
					]
				}
			}
            参数名	    描述
			page            当前页码
			total           数据总条数
			pages           总页数
	        price	        价格
	        total	        下单总量
            trade_amount	已交易数量
            trade_num	        交易订单号
            type	        交易类型(1:买;2:卖)
            status	        订单状态(0:未完成;1:已完成)
	        addtime             订单创建时间
        (8):查询所有市场名称：
		    app.wkj.link/api/getMarketList
        (9):币自动转出
            url:app.wkj.link/order/rollOut 
            请求参数
            参数名	        描述
            access_key	  access_key
            method	  当前方法名称(rollOut)
            coin	  币种名称(wkb,bitcny)
            num	          数量
	        paypassword   交易密码
	        addr          转出地址
	        xrp_tag       可选(币种为eos类型需要填写。其他默认'')
			chain_type    可选(USDT提币可选:ERC20,USDT至TRX时须设置此参数为TRC20)默认ERC20其他币种提币无须设置此参数
            sign	  签名(加密方式详情见demo)
            reqTime	  时间戳
            请求结果：
            {
                "code":200,
                "msg" :'转出申请成功！' 
            }		
        (10):批量撤销挂单(默认一个市场一次请求撤销20单)
		    url:app.wkj.link/order/cancelAll
            请求参数
            参数名	        描述
            access_key	  access_key
            method	  当前方法名称(cancelAll)
            market	  市场名称(wkb_bitcny)
			type      挂单类型(1:买单;2:卖单)
			sign	  签名(加密方式详情见demo)
            reqTime	  时间戳
			请求结果:
			{
				"code":200,
				"msg":"success"
			}
		    如果没有需要撤销的挂单
			{
				"msg":"data is null",
				"code":1018
			}
		
    加密方式：
           https://gitee.com/lianlianyi/zb-api/blob/master/%E5%8A%A0%E5%AF%86.md
  3：demo 地址：
          https://github.com/zpcodemen/wkj_api/tree/master

