pragma solidity 0.8.21;

contract Transaction {
    // Model a Peer
    struct Peer {
        uint id;
        string mail;
    }

    // Read/write Peers
    mapping(uint => Peer) public peers;

    event peerAdded(
        uint id,
        string mail
    );

    // Store Peer Count
    uint public peersCount;

    constructor () public {
        addPeer("abc@gmail.com");
        addPeer("def@gmail.com");
    }

    function addPeer(string memory _mail) public {
        peersCount ++;
        peers[peersCount] = Peer(peersCount, _mail);
        emit peerAdded(peersCount,_mail);
    }
}

contract Trans {
    // Model a Peer
    struct Trans {
        uint id;
        string amt;
    }

    // Read/write Peers
    mapping(uint => Trans) public trans;

    event transAdded(
        uint id,
        string amt
    );

    // Store Peer Count
    uint public transCount;

    constructor () public {
        addTran("750");
        addTran("1250");
    }

    function addTran(string memory _amt) public {
        transCount ++;
        trans[transCount] = Trans(transCount, _amt);
        emit transAdded(transCount,_amt);
    }
}