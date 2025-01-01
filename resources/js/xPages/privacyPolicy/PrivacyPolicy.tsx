import React, { useEffect } from "react";
import { PageTopSection } from "../../xcomponents";

const PrivacyPolicy = () => {
    useEffect(() => {
        window.scrollTo(0, 0);
    }, []);

    return (
        <>
            <PageTopSection
                title={"سياسة الخصوصية"}
                description={"قريباً..."}
            />
            <div className="mt-[6rem] mb-20"></div>
        </>
    );
};

export default PrivacyPolicy;
