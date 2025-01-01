import { useState } from "react";

import TabsButtonBox from "./tabsButtonBox/TabsButtonBox";
import TabsContent from "./tabsContent/TabsContent";

const ReportsTabs = ({ reports, evaluations }) => {
    const [activeTab, setActiveTab] = useState(0);

    return (
        <section className="flex flex-col items-end gap-8">
            <TabsButtonBox activeTab={activeTab} setActiveTab={setActiveTab} />

            <TabsContent
                activeTab={activeTab}
                reports={reports}
                evaluations={evaluations}
            />
        </section>
    );
};

export default ReportsTabs;
