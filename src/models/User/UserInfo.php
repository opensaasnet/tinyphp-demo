<?php
/**
 * @Copyright (C), 2013-, King.
 * @Name UserInfo.php
 * @Author King
 * @Version Beta 1.0 
 * @Date 2021年8月24日下午7:27:26
 * @Description mysql.user
 * @Class List 1.
 * @Function List 1.
 * @History King 2021年8月24日下午7:27:26 第一次建立该文件
 *                 King 2021年8月24日下午7:27:26 修改
 * 
 */
namespace Demo\Model\User;

use Tiny\MVC\Model\Db;

/**
 * db model mysql.user
 * @package App.Model.Main.User
 *
 */
class UserInfo extends Db
{
    
    /**
     * 数据ID
     *  
     * @var string
     */
    protected $dataId = 'default';

    /**
     * 读库ID
     * 
     * @var string
     */
    protected $readDataId = 'default';
    
    /**
     * get mysql users
     * 
     * @return array
     */
    public function getUsers()
    {
        return  $this->fetchall('SELECT host,user FROM :0t WHERE :1', 'user', "user='root'");
    }
}
?>