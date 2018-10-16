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

2：接口说明：请求方式为post.返回json数据
     
     (1)	委托交易api:
             url: www.wkj.link/order/upTrade
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
      Array
      (
          [msg] => 交易委托成功！订单号:15393469943186B7n0aQ12
          [code] => 200
      )

     (2)	撤销交易api:
      url: www.wkj.link/order/Cancel
      参数说明：
          参数名	      描述
          access_key	Access_key
          method	    当前方法名称(Cancel)
          market	    市场名称
          trade_num	  委托订单号
          sign	      签名(加密方式详情见demo)
          reqTime	    毫秒时间戳
     返回值：
      Array
      (
          [0] => 1
          [1] => 撤销成功
      )

    (3)	刷单接口api:
    url: www.wkj.link/order/upOrder

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
      array
      (
          [code] => 200
          [msg] => ok
      )
      (4)	订单状态api
       url: www.wkj.link/order/getTradeStatus
          参数名	     描述
          access_key	Access_key
          method	    当前方法名称(getTradeStatus)
          market	    市场名称
          trade_num	  交易订单号
          sign	      签名(加密方式详情见demo)
          reqTime	    毫秒时间戳
          响应数据：
          Array
          (
              [market] => wkb_cny
              [price] => 2.34800000
              [trade_number] => 15374330818732Ttnrp1
              [total] => 28.24734000
              [trade_amount] => 28.24734000
              [status] => 1
              [type] => 1
              [addtime] => 1537433081
          )
          参数名	        描述
          market	      市场名称
          price	        价格
          trade_number	交易订单号
          total	        下单总量
          trade_amount	已交易数量
          status	      1:交易已完成；0:交易未完成
          type	        1:buy;2:sell
          addtime	      下单时间

          (5)	查询币种余额
            url:www.wkj.com/order/getBalance
              请求参数
              参数名	       描述
              access_key	access_key
              method	    当前方法名称(getBalance)
              coin	      币种名称
              sign	      签名(加密方式详情见demo)
              reqTime	    毫秒时间戳
              请求结果：
              Array
              (
                  [coin] => cny
                  [balance] => 773.10289954
              )
         (6)	查询市场的所有挂单（三天内）
            url:www.wkj.com/order/getOrderStatus 
            请求参数
            参数名	        描述
            access_key	  access_key
            method	      当前方法名称(getOrderStatus)
            market	      市场名称
            status	      订单状态(0:未完成;1:已完成；2返回全部)
            sign	        签名(加密方式详情见demo)
            reqTime	      毫秒时间戳
            请求结果：
            Array
            (
                [code] => 200
                [msg] => Array
                    (
                        [0] => Array
                            (
                                [trade_num] => 15389983989713kKAPNe
                                [type] => 1
                                [status] => 0
                            )
                        [1] => Array
                            (
                                [trade_num] => 1539692492768u1m5UT1
                                [type] => 2
                                [status] => 0
                            )
                    )
            )
            参数名	    描述
            trade_num	交易订单号
            method	  当前方法名称(getOrderStatus)
            status	  订单状态(0:未完成;1:已完成)
     

    加密方式：
           https://gitee.com/lianlianyi/zb-api/blob/master/%E5%8A%A0%E5%AF%86.md
  3：demo 地址：
          https://github.com/zpcodemen/wkj_api/tree/master

