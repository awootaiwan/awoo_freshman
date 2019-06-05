<?php
namespace Dal\Input\OnboardAdmin;

class DelItem extends \Dal\Input {
	
	public function __construct(\CI_Input $ciInput) {
		parent::__construct($ciInput);
	}

	public function initGet() {
		
		return $this;
	}  

	public function initPost() {
	}

	public function initPayloadBody() {
		$this->payloadBody->categoryId = empty($this->payloadBody->categoryId)? "" : (int)$this->payloadBody->categoryId;
        $this->payloadBody->id = empty($this->payloadBody->id)? "" : (int)$this->payloadBody->id;

		return $this;
	}
	
}
