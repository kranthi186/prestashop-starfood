{*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{if isset($wishlists) && count($wishlists) > 1}
	<div class="wishlist">
		{foreach name=wl from=$wishlists item=wishlist}
			{if $smarty.foreach.wl.first}
				<a class="wishlist_button_list" data-link="{$product.id_product|intval}" tabindex="0" data-toggle="popover" data-trigger="focus" title="{l s='Wishlist' mod='blockwishlist'}" data-placement="top">
					<i class="fa fa-heart"></i> <span>{l s='Add to wishlist' mod='blockwishlist'}</span>
				</a>
					<div hidden class="popover-content">
						<table class="table" border="0">
							<tbody>
			{/if}
								<tr title="{$wishlist.name|escape:'html':'UTF-8'}" value="{$wishlist.id_wishlist}" onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|intval}', false, 1, '{$wishlist.id_wishlist}');">
									<td>
										{l s='%s' sprintf=[$wishlist.name] mod='blockwishlist'}
									</td>
								</tr>
			{if $smarty.foreach.wl.last}
						</tbody>
					</table>
				</div>
			{/if}
		{foreachelse}
			<a class="btn btn-outline" href="#" id="wishlist_button_nopop" data-link="{$product.id_product|intval}" onclick="WishlistCart('wishlist_block_list', 'add', '{$id_product|intval}', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;" title="{l s='Add to my wishlist' mod='blockwishlist'}">
				<i class="fa fa-heart"></i> <span>{l s='Add to wishlist' mod='blockwishlist'}</span>
			</a>
		{/foreach}
	</div>
{else}
	<div class="wishlist">
		<a class="addToWishlist wishlistProd_{$product.id_product|intval}" data-link="{$product.id_product|intval}" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '{$product.id_product|intval}', false, 1); return false;" title="{l s='Add to my wishlist' mod='blockwishlist'}">
			<i class="fa fa-heart"></i>
			<span>{l s="Add to Wishlist" mod='blockwishlist'}</span>
		</a>	
	</div>
{/if}