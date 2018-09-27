<?php

namespace Anna\PhotoPostBundle\Controller;

use Anna\PhotoPostBundle\Entity\Post;
use Anna\PhotoPostBundle\Entity\Date;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{
    /**
     * Lists all post entities.
     *
     */
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        // $datesWithPosts = $this->getDoctrine()
        //     ->getRepository(Post::class)
        //     ->getDates();
        $em = $this->getDoctrine()->getManager();
        $title = $request->query->get('title');
        $date = $request->query->get('date');
        $vote = $request->query->get('vote');
        if($date || $vote){
            dump($date,$vote);
            die;
        }
        if($title){
            $posts = $em->getRepository('AnnaPhotoPostBundle:Post')->createQueryBuilder('o')
            ->where('o.title LIKE :title')
            ->setParameter('title', '%'.$title.'%')
            ->getQuery()
            ->getResult();
            return $this->render('post/index.html.twig', array(
                'posts' => $posts,
            ));
        }
        $posts = $em->getRepository('AnnaPhotoPostBundle:Post')->findAll();
        return $this->render('post/index.html.twig', array(
            'posts' => $posts,
        ));
    }

    /**
     * Creates a new post entity.
     *
     */
    public function newAction(Request $request)
    {
        $post = new Post();
        $date = new Date();
        // $post->addDate($date);
        $form = $this->createForm('Anna\PhotoPostBundle\Form\PostType', $post);
        $form->handleRequest($request);
        $uploadPath = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/images';
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $post->getImage();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                $uploadPath,
                $fileName
            );
            $post->setImage($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_show', array('id' => $post->getId()));
        }
        return $this->render('post/new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a post entity.
     *
     */
    public function showAction(Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);

        return $this->render('post/show.html.twig', array(
            'post' => $post,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing post entity.
     *
     */
    public function editAction(Request $request, Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('Anna\PhotoPostBundle\Form\PostType', $post);
        $editForm->handleRequest($request);
        $uploadPath = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/images';
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $post->getImage();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                $uploadPath,
                $fileName
            );
            $post->setImage($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_edit', array('id' => $post->getId()));
        }

        return $this->render('post/edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a post entity.
     *
     */
    public function deleteAction(Request $request, Post $post)
    {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();
        }

        return $this->redirectToRoute('post_index');
    }

    /**
     * Creates a form to delete a post entity.
     *
     * @param Post $post The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */

    private function createDeleteForm(Post $post)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $post->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
