import Container from "../Container";
import ReportsTabs from "./ReportsTabs";
import TextBox from "./TextBox";

import "./ReportsSection.css";

export default function ReportsSection({ reports, evaluations, marginTop }) {
    return (
        <section className="section-box-shadow rounded-[10px] md:mt-[42rem] lg:mt-48 mt-96 lg:mb-0 mb-16 pb-12">
            <Container>
                <TextBox />
                <ReportsTabs reports={reports} evaluations={evaluations} />
            </Container>
        </section>
    );
}
