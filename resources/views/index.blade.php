@extends('layouts.app')

@section('content')

<div class="container-fluid">

  {{-- Row --}}
  <div class="row justify-content-center">

    <div class="col-sm-10 d-flex justify-content-center text-center">
    <div class="jumbotron">
      <img src="img/logo2.png" class="imageRotateHorizontal" width="15%"> </br>
      <img src="img/slogan.png" width="13%">
      <h2 class="mt-5">Bhutan Telecom Vivo Phones Sale Registry</h2>
      <hr class="my-4">
      <p>Uses Blockchain Technology to register the purchase details in the Blockchain Network which is immutable.</p>
    </div>
    </div>

  </div><hr>

  <div class="header-section">
        <h2 class="dark big">Resources</h2>
  </div>
    
  <!-- Resources -->
  <div class="container-grid-2">
      <div>
          <img class="img-team" src="img/metamask.png" width="90%">
      </div>
      <div>
          <h2 class="orange-txt">Metamask</h2>
          <p>MetaMask is a bridge that allows you to visit the distributed web of tomorrow in your browser today.
            It allows you to run Ethereum dApps right in your browser without running a full Ethereum node.</p>
          <div class="btn-wrapper">
              <a href="https://metamask.io" target="_blank">Learn More </a>
          </div>
      </div>
  </div>

  <hr>
  <!-- Resources -->
  <div class="container-grid-2">
    
    <div>
        <h2 class="orange-txt">Smart Contract</h2>
        <p>A smart contract is a computer program or a transaction protocol which is intended to automatically execute, control or document legally relevant events and actions according to the terms of a contract or an agreement.
          The objectives of smart contracts are the reduction of need in trusted intermediators, arbitrations and enforcement costs, fraud losses, as well as the reduction of malicious and accidental exceptions</p>
        <div class="btn-wrapper">
            <a href="https://en.wikipedia.org/wiki/Smart_contract" target="_blank">Learn More </a>
        </div>
    </div>

    <div>
      <img class="img-team" src="img/contract.png" width="90%">
    </div>
  </div>

  <hr>
  <!-- Resources -->
  <div class="container-grid-2">
      
    <div>
      <img class="img-team" src="img/ethereum.png" width="60%">
    </div>

    <div>
        <h2 class="orange-txt">Ethereum Network</h2>
        <p>Ethereum is a decentralized, open-source blockchain with smart contract functionality. Ether is the native cryptocurrency of the platform.
          It is the second-largest cryptocurrency by market capitalization, after Bitcoin. Ethereum is the most actively used blockchain.</p>
        <div class="btn-wrapper">
            <a href="https://ethereum.org/en/" target="_blank">Learn More </a>
        </div>
    </div>
  </div>

  <hr>
  <!-- Resources -->
  <div class="container-grid-2">
  
    <div>
        <h2 class="orange-txt">Truffle Framework</h2>
        <p>Truffle is a development environment, testing framework and asset pipeline for Ethereum,
          aiming to make life as an Ethereum developer easier.</p>
        <div class="btn-wrapper">
            <a href="https://www.trufflesuite.com" target="_blank">Learn More </a>
        </div>
    </div>

    <div>
      <img class="img-team" src="img/truffle.png" width="40%">
    </div>

  </div>
</div>

@endsection