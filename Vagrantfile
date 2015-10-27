# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.box = "ubuntu/trusty64"

  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network "private_network", ip: "10.0.11.10"

  config.vm.hostname = "pricing.co.uk"

  config.ssh.forward_agent = true

  config.vm.provider "virtualbox" do |vb|
      vb.gui = false
      vb.memory = 2048
      vb.cpus = 2  #
  end

  config.vm.provision :file,
    source: '~/.gitconfig',
    destination: '~/.gitconfig'

  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
   config.vm.provision "shell", inline: <<-SHELL
     sudo apt-get update
     sudo apt-get install -y php5 php5-dev php5-curl php5-sqlite sqlite

     curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
   SHELL
end
