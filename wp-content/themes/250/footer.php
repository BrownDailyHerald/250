  <?php if ( is_front_page() ): ?>
  <footer class="bottom">
    <table>
      <tr>
        <td>Fireworks photo by Emily Gilbert</td>
        <td><a href="<?php echo get_site_url(null, 'category/miscellaneous/'); ?>">From the Magazine</a></td>
        <td style="text-align: right; padding-right: 20px;">Site by Joe Stein and Cody Ma</td>
      </tr>
    </table>
  </footer>	
  <?php endif; ?>
  <?php wp_footer(); ?>
</body>
</html>
