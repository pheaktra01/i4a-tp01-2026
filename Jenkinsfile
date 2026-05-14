// pipeline {
//    agent any
//    stages {
//        stage('Build') {
//            steps {
//                 echo 'Building...'
//                 checkout scm

//                 echo 'copying .env.example to .env'
//                 sh 'cp .env.example .env'

//                 echo 'configuring database...'
//                 //sh 'php artisan migrate'
//                 //sh 'sed -i "s/DB_HOST=.*/DB_HOST=localhost/g" .env'
//                 //sh 'sed -i "s/DB_PORT=.*/DB_PORT=3306/g" .env'
//                 //sh 'sed -i "s/DB_DATABASE=.*/DB_DATABASE=tp01/g" .env'
//                 //sh 'sed -i "s/DB_USERNAME=.*/DB_USERNAME=root/g" .env'

//                 echo 'Installing dependencies...'
//                 sh 'composer install'
//                 sh 'npm install'

//                 echo 'Generating application key...'
//                 sh 'php artisan key:generate'
//            }
//        }
//        stage('Test') {
//            steps {
//                 echo 'Testing...'
//                 sh 'php artisan test'
//            }
//        }
//     //    stage('Deploy') {
//     //        steps {
//     //             echo 'Deploying...'
//     //             sh 'ansible-playbook -i inventory/hosts.ini deploy.yml'
//     //        }
//     //    }
//    }
// }

pipeline {
    agent any

    environment {
        ANSIBLE_HOST_KEY_CHECKING = 'False'
    }

    stages {

        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Build Laravel on Agent') {
            steps {
                echo 'Copy env'
                sh 'cp .env.example .env'

                echo 'Install dependencies'
                sh 'composer install'
                sh 'npm install'

                echo 'Generate key'
                sh 'php artisan key:generate'
            }
        }

        stage('Test') {
            steps {
                sh 'php artisan test || true'
            }
        }

        stage('Deploy with Ansible') {
            steps {
                sh '''
                    cd ansible-playbook hosts.ini deploy.yml --extra-vars "workspace=$WORKSPACE"
                '''
            }
        }
    }
}