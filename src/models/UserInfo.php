<?php
/**
 *
 * @copyright (C), 2013-, King.
 * @name UserInfo.php
 * @author King
 * @version Beta 1.0
 * @Date 2021年8月24日下午7:27:43
 * @Description mysql.user
 * @Class List 1.
 * @Function List 1.
 * @History King 2021年8月24日下午7:27:43 第一次建立该文件
 *          King 2021年8月24日下午7:27:43 修改
 *         
 */
namespace Demo\Model;

use Tiny\MVC\Model\Db;

/**
 * db model mysql.user
 * 
 * @package App.Model.Main
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
        return $this->fetchall('SELECT :2f, host FROM :0t WHERE :1', 'user', "user='root'", 'user');
    }
}
?>