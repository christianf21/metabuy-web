<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<h3>Hey <span style="font-weight:normal;"><?php echo $username ?></span> and welcome to Prime NikeBots!</h3>

<p>You are now registered into our system, all you need to do is confirm your email address by clicking in the "Confirm Email" button below:</p>

<br />

<br />


	<a href='<?php echo $this->Html->url(array("controller"=>"users","action"=>"confirmEmail"),$token,$userId); ?>'
            style="margin-left:20%;padding:18px;background-color:#0094D5;font-size:17px;color:white;cursor:pointer;text-decoration:none;">Confirm my Email Address</a>

<br />
<br />

<br />

<p>Stay tuned for more offers and bots coming out, as well as stay up to date with the next Shoe Releases at our website.</p>
<p>Theres many things we offer to our Clients, so go and check them out!</p>
<p>Prime NikeBot team.</p>