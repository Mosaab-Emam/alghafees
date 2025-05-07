import Layout from "@/Pages/layout/Layout";
import { PageTopSection } from "@/components";
import Container from "@/components/Container";
import { Post, Tag } from "@/types";
import BlogDetailsTitleBox from "./BlogDetailsTitleBox";
import BlogDetailsTopBox from "./BlogDetailsTopBox";
import ArticleBox from "./articleBox/ArticleBox";
import RelatedTopics from "./relatedTopics/RelatedTopics";

import "../../blog/banner.css";

const BlogDetailsPage = ({
    tags,
    post,
    main_tag,
    post_content,
    latest_posts,
    related_posts,
}: {
    tags: Array<Tag>;
    post: Post;
    main_tag: string;
    post_content: string;
    latest_posts: Array<Post>;
    related_posts: Array<Post>;
}) => {
    post.content.ar = post_content;
    return (
        <>
            <PageTopSection title={"المدونة"} description={"نصائح عقارية"} />
            <Container>
                <section className="md:mt-[211px] top-[6rem] relative">
                    <BlogDetailsTopBox post={post} tags={tags} />
                    <BlogDetailsTitleBox post={post} main_tag={main_tag} />
                    <ArticleBox post={post} latest_posts={latest_posts} />
                    <RelatedTopics related_posts={related_posts} />
                </section>
            </Container>
        </>
    );
};

BlogDetailsPage.layout = (page: React.ReactNode) => <Layout children={page} />;

export default BlogDetailsPage;
