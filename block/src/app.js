App = {
    loading: false,
    contracts: {},
  
    load: async () => {
      await App.loadWeb3()
      await App.loadAccount()
      await App.loadContract()
      await App.render()
    },
  
    // https://medium.com/metamask/https-medium-com-metamask-breaking-change-injecting-web3-7722797916a8
    loadWeb3: async () => {
        try {
            if (window.ethereum) {
                window.web3 = new Web3(window.ethereum);
                await window.ethereum.request({ method: 'eth_requestAccounts' });
                App.web3 = window.web3; // Set App.web3 here
            } else if (window.web3) {
                window.web3 = new Web3(window.web3.currentProvider);
                App.web3 = window.web3; // Set App.web3 here
            } else {
                console.log('Non-Ethereum browser detected. You should consider trying MetaMask!');
            }
        } catch (error) {
            console.error('Error while loading Web3:', error);
            // Handle errors here
        }
    },
    
    
  
    loadAccount: async () => {
        try {
            if (!App.web3) {
                console.error('web3 is not initialized');
                return;
            }
    
            const accounts = await App.web3.eth.getAccounts();
            if (accounts.length > 0) {
                App.account = accounts[0];
                console.log('Current account:', App.account);
            } else {
                console.error('No accounts found');
            }
        } catch (error) {
            console.error('Error while loading account:', error);
            // Handle errors here
        }
    },
    
    
     
     loadContract: async () => {
        try {
            if (!App.web3) {
                console.error('web3 is not initialized');
                return;
            }
    
            const transactionData = await $.getJSON('Transaction.json');
            const Transaction = TruffleContract(transactionData);
            Transaction.setProvider(App.web3.currentProvider);
    
            // Deployed contract instance
            App.transaction = await Transaction.deployed();
        } catch (error) {
            console.error('Error while loading contract:', error);
            // Handle errors here
        }
    },
    
      
  
    render: async () => {
      // Prevent double render
      if (App.loading) {
        return
      }
  
      // Update app loading state
      App.setLoading(true)
  
      // Render Account
      $('#account').html(App.account)
  
      // Render Tasks
      await App.renderTransactions()
  
      // Update loading state
      App.setLoading(false)
    },
  
    renderTransactions: async () => {
        try {
            if (!App.transaction) {
                console.error('Contract instance not initialized');
                return;
            }
    
            // Load the total peer count from the blockchain
            const peersCount = await App.transaction.peersCount();
            // ... Rest of your code for rendering transactions
            const $taskTemplate = $('.taskTemplate')
  
      // Render out each task with a new task template
      for (var i = 1; i <= peersCount; i++) {
        // Fetch the task data from the blockchain
        const peer = await App.transaction.peers(i)
        const peerId = peer[0].toNumber()
        const peerMail = peer[1]
        console.log('Peer ID:', peerId); // Log peer ID
        console.log('Peer Mail:', peerMail); // Log peer Mail

        // Create the html for the task
        const $newTaskTemplate = $taskTemplate.clone();
        $newTaskTemplate.find('.content').text(peerMail);

        // Append the task/peer to the task list container
        $('#taskList').append($newTaskTemplate.html());
        // console.log(peerId)
        // console.log(peerMail)
        // //const Amount = task[2]
  
        // // Create the html for the task
        // //const $newTaskTemplate = $taskTemplate.clone();
        // $taskTemplate.find('.content').text(peerMail);
                        // .on('click', App.toggleCompleted)
  
        // Put the task in the correct list
        // if (taskCompleted) {
        //   $('#completedTaskList').append($newTaskTemplate)
        // } else {
        //   $('#taskList').append($newTaskTemplate)
        // }
  
        // Show the task
        $newTaskTemplate.show()
      }
        } catch (error) {
            console.error('Error while rendering transactions:', error);
            // Handle errors here
        }
    },
      
  
    addPeer: async () => {
        try {
            if (!App.web3) {
                console.error('web3 is not initialized');
                return;
            }
            const transactionData = await $.getJSON('../build/contracts/Transaction.json');
            const Transaction = TruffleContract(transactionData);
            Transaction.setProvider(App.web3.currentProvider);
            // Deployed contract instance
            App.transaction = await Transaction.deployed();
            App.setLoading(true);
            const content = $('#newTask').val();
            console.log(content)
            // Call the addPeer function on the contract instance
           // Assuming the contract is already deployed and initialized correctly
            App.transaction.addPeer(content)
            .on('transactionHash', function(hash) {
            // Transaction sent, handle transaction hash
            console.log("Transaction sent. Hash:", hash);
            })
            .on('receipt', function(receipt) {
            // Transaction receipt received, handle receipt
            console.log("Transaction receipt:", receipt);
            })
            .on('error', function(error, receipt) {
            // Error occurred, handle error
            console.error("Error:", error);
            if (receipt) {
                console.log("Receipt:", receipt);
            }
});
            // Reload the page or update the UI as needed
            //window.location.reload();
          } catch (error) {
            console.error('Error while adding peer:', error);
            // Handle error
          }
  
    },
  
    // toggleCompleted: async (e) => {
    //   App.setLoading(true)
    //   const taskId = e.target.name
    //   await App.todoList.toggleCompleted(taskId)
    //   window.location.reload()
    // },
  
    setLoading: (boolean) => {
      App.loading = boolean
      const loader = $('#loader')
      const content = $('#content')
      if (boolean) {
        loader.show()
        content.hide()
      } else {
        loader.hide()
        content.show()
      }
    }
  }
  
  $(() => {
    $(window).load(() => {
      App.load()
    })
  })