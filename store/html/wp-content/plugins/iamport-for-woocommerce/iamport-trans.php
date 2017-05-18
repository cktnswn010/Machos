<?php
class WC_Gateway_Iamport_Trans extends Base_Gateway_Iamport {

	public function __construct() {
		parent::__construct();

		$this->method_title = __( '아임포트(실시간계좌이체)', 'iamport-for-woocommerce' );
		$this->method_description = __( '=> 아임포트 서비스를 이용해 결제모듈을 연동할 수 있습니다.<br>=> [아임포트] X PG사 제휴할인혜택을 받아보세요! <a href="http://www.iamport.kr/pg#promotion" target="_blank">PG 신규계약 프로모션 안내</a><br>=> 아임포트의 최신 공지사항도 놓치지 마세요! <a href="http://www.iamport.kr/notice" target="_blank">공지사항보기</a>', 'iamport-for-woocommerce' );
		$this->has_fields = true;
		$this->supports = array( 'products', 'refunds' );

		//settings
		$this->title = $this->settings['title'];
		$this->description = $this->settings['description'];
		$this->escrow = $this->settings['escrow'];
		$this->pg_provider = $this->settings['pg_provider'];

		//actions
		// add_action( 'woocommerce_thankyou_'.$this->id, array( $this, 'iamport_order_detail' ) ); woocommerce_order_details_after_order_table 로 대체. 중복으로 나오고 있음
	}

	protected function get_gateway_id() {
		return 'iamport_trans';
	}

	public function init_form_fields() {
		parent::init_form_fields();

		$this->form_fields = array_merge( array(
			'enabled' => array(
				'title' => __( 'Enable/Disable', 'woocommerce' ),
				'type' => 'checkbox',
				'label' => __( '아임포트(실시간계좌이체) 결제 사용', 'iamport-for-woocommerce' ),
				'default' => 'yes'
			),
			'title' => array(
				'title' => __( 'Title', 'woocommerce' ),
				'type' => 'text',
				'description' => __( '구매자에게 표시될 구매수단명', 'iamport-for-woocommerce' ),
				'default' => __( '실시간계좌이체 결제', 'iamport-for-woocommerce' ),
				'desc_tip'      => true,
			),
			'description' => array(
				'title' => __( 'Customer Message', 'woocommerce' ),
				'type' => 'textarea',
				'description' => __( '구매자에게 결제수단에 대한 상세설명을 합니다.', 'iamport-for-woocommerce' ),
				'default' => __( '주문확정 버튼을 클릭하시면 실시간계좌이체 결제창이 나타나 결제를 진행하실 수 있습니다.', 'iamport-for-woocommerce' )
			),
			'escrow' => array(
				'title' => __( '실시간계좌이체 에스크로', 'iamport-for-woocommerce' ),
				'type' => 'checkbox',
				'label' => __( '실시간계좌이체 결제수단을 에스크로 방식으로 제공할까요?', 'iamport-for-woocommerce' ),
				'default' => 'no',
				'description' => __( '일반 실시간계좌이체가 에스크로(구매자 안전결제)방식의 실시간계좌이체로 대체됩니다.', 'iamport-for-woocommerce' )
			),
			'pg_provider' => array(
				'title' => __( '복수 PG설정', 'iamport-for-woocommerce' ),
				'type' => 'select',
				'default' => '',
				'description' => __( '2개 이상의 PG사를 이용 중이라면, 실시간계좌이체를 서비스할 PG사를 선택해주세요. 선택된 PG사의 결제창이 호출됩니다.', 'iamport-for-woocommerce' ),
				'options' => array(
					'none' => '해당사항없음',
					'html5_inicis' => 'KG이니시스-웹표준결제',
					'uplus' => 'LGU+',
					'nice' => '나이스정보통신',
					'jtnet' => 'JTNet',
					'danal_tpay' => '다날-계좌이체'
				)
			)
		), $this->form_fields);
	}

	public function iamport_payment_info( $order_id ) {
		$iamport_info = parent::iamport_payment_info( $order_id );
		$iamport_info['escrow'] = ($this->escrow == 'yes');
		if ( !empty($this->pg_provider) && $this->pg_provider != 'none' ) $iamport_info['pg'] = $this->pg_provider;

		return $iamport_info;
	}

	public function iamport_order_detail( $order_id ) {
		global $woocommerce;

		$order = new WC_Order( $order_id );

		$paymethod = get_post_meta($order_id, '_iamport_paymethod', true);
		$receipt_url = get_post_meta($order_id, '_iamport_receipt_url', true);
		$vbank_name = get_post_meta($order_id, '_iamport_vbank_name', true);
		$vbank_num = get_post_meta($order_id, '_iamport_vbank_num', true);
		$vbank_date = get_post_meta($order_id, '_iamport_vbank_date', true);
		$tid = $order->get_transaction_id();

        ob_start();
		?>
		<h2><?=__( '결제 상세', 'iamport-for-woocommerce' )?></h2>
		<table class="shop_table order_details">
			<tbody>
				<tr>
					<th><?=__( '결제수단', 'iamport-for-woocommerce' )?></th>
					<td><?=__( '실시간계좌이체', 'iamport-for-woocommerce' )?></td>
				</tr>
				<tr>
					<th><?=__( '매출전표', 'iamport-for-woocommerce' )?></th>
					<td><a target="_blank" href="<?=$receipt_url?>"><?=sprintf( __( '영수증보기(%s)', 'iamport-for-woocommerce' ), $tid )?></a></td>
				</tr>
			</tbody>
		</table>
		<?php 
		ob_end_flush();
	}
	
}