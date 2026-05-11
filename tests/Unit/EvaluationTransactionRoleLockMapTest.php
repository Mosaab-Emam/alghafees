<?php

namespace Tests\Unit;

use App\Models\Evaluation\EvaluationTransaction;
use Tests\TestCase;

/**
 * DB integration tests for role locks are omitted: RefreshDatabase fails on this repo
 * because migration 2023_03_019_203105 runs before create_evaluation_transactions by filename order.
 */
class EvaluationTransactionRoleLockMapTest extends TestCase
{
    public function test_role_assignment_lock_map_covers_four_roles(): void
    {
        $this->assertSame([
            'previewer_id' => 'previewer_locked_by',
            'income_id' => 'income_locked_by',
            'review_id' => 'review_locked_by',
            'approver_id' => 'approver_locked_by',
        ], EvaluationTransaction::roleAssignmentLockMap());
    }
}
