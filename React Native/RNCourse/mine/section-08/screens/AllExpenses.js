import { useContext, useEffect, useState } from "react";
import ExpensesOutput from "../components/ExpensesOutput/ExpensesOutput";
import LoadingOverlay from "../components/UI/LoadingOverlay";
import { ExpensesContext } from "../store/expenses-context";
import { fetchExpense } from "../utils/http";

function AllExpenses() {
  const [isFetching, setIsFetching] = useState(true);
  const expensesCtx = useContext(ExpensesContext);

  useEffect(() => {
    (async function getExpenses() {
      setIsFetching(true);
      const expenses = await fetchExpense();
      setIsFetching(false);
      expensesCtx.setExpenses(expenses);
    })();
  }, []);

  if (isFetching) {
    return <LoadingOverlay />;
  }

  return (
    <ExpensesOutput
      expenses={expensesCtx.expenses}
      expensesPeriod="Total"
      fallbackText="No expenses registered found!"
    />
  );
}

export default AllExpenses;
