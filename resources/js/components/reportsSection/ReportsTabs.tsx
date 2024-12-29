import React, { useState } from "react";

import TabsButtonBox from "./tabsButtonBox/TabsButtonBox";
import TabsContent from "./tabsContent/TabsContent";

const ReportsTabs = () => {
	const [activeTab, setActiveTab] = useState(0);

	return (
		<section className='flex flex-col items-end gap-8'>
			<TabsButtonBox activeTab={activeTab} setActiveTab={setActiveTab} />

			<TabsContent activeTab={activeTab} />
		</section>
	);
};

export default ReportsTabs;
