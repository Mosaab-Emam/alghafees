import React from "react";
import TabButton from "./TabButton";

const tabsButtons = ["التقارير", "التقييمات"];

const TabsButtonBox = ({ activeTab, setActiveTab }) => {
    return (
        <div className="flex items-start gap-[20px] self-stretch justify-between">
            <>
                {tabsButtons.map((button, index) => (
                    <TabButton
                        key={index}
                        index={index}
                        activeTab={activeTab}
                        onActiveHandler={() => setActiveTab(index)}
                    >
                        {button}
                    </TabButton>
                ))}
            </>
        </div>
    );
};

export default TabsButtonBox;
