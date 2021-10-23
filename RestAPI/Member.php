<?php
require CONTROL . "Contact.php";
require CONTROL . "Mail.php";
require CONTROL . "Ward.php";

class Member extends Page
{
    public function Register()
    {
        $data = $this->request->getDataPost();
        $errors = $this->validateRegister($data);
        if (empty($errors)) {
            $ctlContact = new \Lib\Contact($this->api);
            if(!isset($data['firstname'])){
                $arr = explode($data['fullname']);
                $data['lastname'] = $arr[0];
                $firstname = array();
                for ($i=1;$i<count($arr);$i++){
                    $firstname[] = $arr[$i];
                }
                $data['firstname'] = implode(' ',$firstname);
            }
            $contact = array(
                'title' => $data['title'],
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'provinceid' => isset($data['province']) ? $data['province'] : 0,
                'districtid' => isset($data['district']) ? $data['district'] : 0,
                'wardid' => isset($data['ward']) ? $data['ward'] : 0,
                'type' => '[customer]',
                'activecode' => $this->string->generateRandStr(16),
                'status' => 'inactive',
            );
            $data = $ctlContact->save($contact);
            //Gửi mail kích hoạt tài khoản
            $body = $this->section->loadView('Register/RegisterEmail.html', array(
                'email' => $contact['email'],
                'activecode' => $contact['activecode'],
                'linkactive' => $this->request->createLink('activeaccount')
            ));
            $mail = array(
                'mailto' => array(
                    array('email' => $contact['email'], 'name' => $contact['fullname'])
                ),
                'mailreply' => '',
                'mailreplyname' => '',
                'mailcc' => '',
                'mailbcc' => '',
                'attachments' => '',
                'subject' => 'Bạn đã đăng ký tài khoản thành công',
                'body' => $body,
                'bodytext' => strip_tags($body),
            );
            $ctlMail = new \Lib\Mail($this->api);
            $ctlMail->sendMail($mail);
            return json_encode($data);
        } else {
            return json_encode(array(
                'statuscode' => 0,
                'text' => 'Save failed',
                'data' => $errors
            ));
        }

    }

    private function validateRegister($data)
    {
        $errors = array();
        if (empty($data['firstname'])) {
            $errors['firstname'] = 'Bạn chưa nhập tên';
        }
        if (empty($data['lastname'])) {
            $errors['lastname'] = 'Bạn chưa nhập họ';
        }
        if (empty($data['email'])) {
            $errors['email'] = 'Bạn chưa nhập email';
        }
        if (empty($data['phone'])) {
            $errors['phone'] = 'Bạn chưa nhập số điện thoại';
        }
        return $errors;
    }

    public function UpdateInformation()
    {
        $data = $this->request->getDataPost();
        $errors = $this->validateRegister($data);
        if (empty($errors)) {
            $ctlContact = new \Lib\Contact($this->api);
            $contact = array(
                'id' => $this->member['id'],
                'title' => $data['title'],
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'wardid' => isset($data['ward']) ? $data['ward'] : 0,
            );
            if (!empty($_FILES['avatar'])) {
                $contact['avatar_value'] = 'true';
                $cache = new \Lib\Cache();
                $fileContent = file_get_contents($_FILES['avatar']['tmp_name']);
                $cache->create($_FILES['avatar']['name'], $fileContent);
                $contact['avatar'] = new CURLFILE($cache->getPath($_FILES['avatar']['name']));
            }

            $data = $ctlContact->save($contact);
            $this->loadData();
            return json_encode($data);
        } else {
            return json_encode(array(
                'statuscode' => 0,
                'text' => 'Save failed',
                'data' => $errors
            ));
        }
    }

    private function loadData($contact = array())
    {
        if (empty($contact)) {
            $ctlContact = new \Lib\Contact($this->api);
            $contact = $ctlContact->getItem($this->member['id']);
        }
        $ward = new \Lib\Ward($this->api);
        if(isset($contact['wardid'])){
            $contact['ward'] = $ward->getItem($contact['wardid']);
        }
        $this->session->set('member', $contact);
    }

    public function Active()
    {
        $data = $this->request->getDataPost();
        $errors = $this->validateActive($data);
        if (empty($errors)) {
            $ctlContact = new \Lib\Contact($this->api);
            $contacts = $ctlContact->getGetList('&email=equal_' . $data['email']);
            $contact = array(
                'id' => $contacts[0]['id'],
                'status' => 'active',
                'password' => $this->string->encryptionPassword($data['password']),
            );
            $data = $ctlContact->save($contact);
            return json_encode($data);
        } else {
            return json_encode(array(
                'statuscode' => 0,
                'text' => 'Active failed',
                'data' => $errors
            ));
        }

    }

    private function validateActive($data)
    {
        $ctlContact = new \Lib\Contact($this->api);
        $errors = array();
        $contacts = $ctlContact->getGetList('&email=equal_' . $data['email']);
        if (!empty($contacts)) {
            $contact = $contacts[0];
            if ($contact['status'] == 'active') {
                $errors['email'] = 'Tài khoản đã được kích hoạt';
                return $errors;
            }
        }
        if (empty($data['email'])) {
            $errors['email'] = 'Bạn chưa email!';
        } else {
            if (empty($contacts)) {
                $errors['email'] = "Email chưa tồn tại!";
            }
        }
        if (empty($data['activecode'])) {
            $errors['activecode'] = 'Bạn chưa nhập mã kích hoạt';
        } else {
            if (!empty($contacts)) {
                $contact = $contacts[0];
                if ($contact['activecode'] != $data['activecode']) {
                    $errors['activecode'] = 'Mã kích hoạt không đúng!';
                }
            }
        }
        if (empty($data['password'])) {
            $errors['password'] = 'Bạn chưa nhập mật khẩu';
        }
        if (empty($data['confirmpassword'])) {
            $errors['confirmpassword'] = 'Bạn chưa nhập xác nhận mật khẩu';
        } else {
            if ($data['password'] != $data['confirmpassword']) {
                $errors['confirmpassword'] = 'Xác nhận mật khẩu không đúng!';
            }
        }
        return $errors;
    }

    public function Login()
    {
        $data = $this->request->getDataPost();
        $email = $data['email'];
        $password = $data['password'];
        if (empty($email)) {
            $errors['email'] = "Bạn chưa nhập email!";
        }
        if (empty($password)) {
            $errors['password'] = "Bạn chưa nhập mật khẩu!";
        }
        if (!empty($errors)) {
            return json_encode(array(
                'statuscode' => 0,
                'text' => 'Login failed',
                'data' => $errors
            ));
        } else {
            $ctlContact = new \Lib\Contact($this->api);
            $errors = array();
            $contacts = $ctlContact->getGetList('&email=equal_' . $email);
            if (empty($contacts)) {
                $errors['email'] = "Không tồn tại email!";
                return json_encode(array(
                    'statuscode' => 0,
                    'text' => 'Login failed',
                    'data' => $errors
                ));
            } else {
                $contact = $contacts[0];
                if ($contact['password'] == $this->string->encryptionPassword($password)) {
                    $this->loadData($contact);
                    return json_encode(array(
                        'statuscode' => 1,
                        'text' => 'Login success',
                        'data' => array()
                    ));
                } else {
                    $errors['password'] = "Mật khẩu không đúng!";
                    return json_encode(array(
                        'statuscode' => 0,
                        'text' => 'Login failed',
                        'data' => $errors
                    ));
                }
            }
        }
    }

    public function ResetPassword()
    {
        $data = $this->request->getDataPost();
        $email = $data['email'];
        $errors = array();
        if (empty($email)) {
            $errors['email'] = "Bạn chưa nhập email!";
        }
        if (!empty($errors)) {
            return json_encode(array(
                'statuscode' => 0,
                'text' => 'Login failed',
                'data' => $errors
            ));
        } else {
            $ctlContact = new \Lib\Contact($this->api);
            $errors = array();
            $contacts = $ctlContact->getGetList('&email=equal_' . $email);
            if (empty($contacts)) {
                $errors['email'] = "Không tồn tại email!";
                return json_encode(array(
                    'statuscode' => 0,
                    'text' => 'Login failed',
                    'data' => $errors
                ));
            } else {

                $password = $this->string->generateRandStr(10);
                $contact = array(
                    'id' => $contacts[0]['id'],
                    'password' => $this->string->encryptionPassword($password),
                );
                $ctlContact->save($contact);
                //Gửi mail cấp mật khẩu mới
                $body = $this->section->loadView('Login/ResetPasswordEmail.html', array(
                    'email' => $email,
                    'password' => $password,
                    'linklogin' => $this->request->createLink('login')
                ));
                $mail = array(
                    'mailto' => array(
                        array('email' => $contacts[0]['email'], 'name' => $contacts[0]['fullname'])
                    ),
                    'mailreply' => '',
                    'mailreplyname' => '',
                    'mailcc' => '',
                    'mailbcc' => '',
                    'attachments' => '',
                    'subject' => 'Yêu cầu cấp lại nhật khẩu thành công!',
                    'body' => $body,
                    'bodytext' => strip_tags($body),
                );
                $ctlMail = new \Lib\Mail($this->api);
                $ctlMail->sendMail($mail);
                return json_encode(array(
                    'statuscode' => 1,
                    'text' => 'Reset password success',
                    'data' => array()
                ));
            }
        }
    }

    public function ChangePassword()
    {
        $data = $this->request->getDataPost();
        $curentpassword = $data['curentpassword'];
        $newpassword = $data['newpassword'];
        $confirmnewpassword = $data['confirmnewpassword'];
        $errors = array();
        if (empty($curentpassword)) {
            $errors['curentpassword'] = "Bạn chưa nhập mật khẩu hiện tại!";
        } else {
            if ($this->string->encryptionPassword($curentpassword) != $this->member['password']) {
                $errors['curentpassword'] = "Mật khẩu hiện tại không đúng!";
            }
        }
        if (empty($newpassword)) {
            $errors['newpassword'] = "Bạn chưa nhập mật mới!";
        }
        if (empty($confirmnewpassword)) {
            $errors['confirmnewpassword'] = "Bạn chưa nhập xác nhận mật khẩu mới!";
        } else {
            if ($newpassword != $confirmnewpassword) {
                $errors['confirmnewpassword'] = "Xác nhận mật khẩu không đúng";
            }
        }
        if (!empty($errors)) {
            return json_encode(array(
                'statuscode' => 0,
                'text' => 'Change password failed',
                'data' => $errors
            ));
        } else {
            $ctlContact = new \Lib\Contact($this->api);
            $this->member['password'] = $this->string->encryptionPassword($newpassword);
            $contact = array(
                'id' => $this->member['id'],
                'password' => $this->member['password'],
            );
            $ctlContact->save($contact);
            $this->loadData();
            return json_encode(array(
                'statuscode' => 1,
                'text' => 'Change password success',
                'data' => array()
            ));

        }
    }

    public function Logout()
    {
        $this->session->remove('member');
        return json_encode(array(
            'statuscode' => 1,
            'text' => 'Logout success',
            'linklogout' => $this->request->createLink(''),
            'data' => array()
        ));
    }
}