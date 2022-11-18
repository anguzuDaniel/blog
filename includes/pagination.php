                        <!-- gets current file location -->
                        <?php $base = strtok($_SERVER['REQUEST_URI'], '?'); ?>

                        <nav class="table__footer table__footer--result">

                            <div>
                                <?php if ($paginator->previous) : ?>
                                    <a href="<?= $base ?>?page=<?= $paginator->previous; ?>">previous</a>
                                <?php else : ?>
                                    <p>previous</p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <?php if ($paginator->next) : ?>
                                    <a href="<?= $base ?>?page=<?= $paginator->next; ?>">next</a>
                                <?php else : ?>
                                    <p>next</p>
                                <?php endif; ?>
                            </div>
                        </nav>