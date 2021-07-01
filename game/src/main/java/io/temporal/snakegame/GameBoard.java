package io.temporal.snakegame;

import com.fasterxml.jackson.databind.JsonNode;
import io.temporal.client.WorkflowClient;
import io.temporal.client.WorkflowStub;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;

public class GameBoard extends JPanel implements ActionListener {

    private int appleX;
    private int appleY;

    private boolean leftDirection = false;
    private boolean rightDirection = true;
    private boolean upDirection = false;
    private boolean downDirection = false;
    private boolean inGame = true;

    private Timer timer;
    private Image ball;
    private Image apple;
    private Image head;

    private JsonNode gameInfo;
    private GameRulesWorkflowInterface boardRulesWorkflow;

    public GameBoard(JsonNode gameInfo, GameRulesWorkflowInterface boardRulesWorkflow) {
        this.gameInfo = gameInfo;
        this.boardRulesWorkflow = boardRulesWorkflow;
        WorkflowClient.start(this.boardRulesWorkflow::exec, gameInfo.toString(),
        new int[1], new int[1], 3);

        initGameBoard();
    }

    private void initGameBoard() {

        addKeyListener(new GameKeyAdapter());
        setBackground(Color.black);
        setFocusable(gameInfo.get("allDots").asBoolean());

        setPreferredSize(new Dimension(gameInfo.get("bWidth").asInt(), gameInfo.get("bHeight").asInt()));
        loadImages();
        initGame();
    }

    private void loadImages() {

        ImageIcon iid = new ImageIcon(gameInfo.get("dotimg").asText());
        ball = iid.getImage();

        ImageIcon iia = new ImageIcon(gameInfo.get("appleimg").asText());
        apple = iia.getImage();

        ImageIcon iih = new ImageIcon(gameInfo.get("headimg").asText());
        head = iih.getImage();
    }

    private void initGame() {
        boardRulesWorkflow.init();
        //boardRulesStub.signal("init");

        locateApple();

        timer = new Timer(gameInfo.get("delay").asInt(), this);
        timer.start();
    }

    @Override
    public void paintComponent(Graphics g) {
        super.paintComponent(g);

        ImageIcon img = new ImageIcon(gameInfo.get("temporalimg").asText());
        g.drawImage(img.getImage(), 0, 0, this.getWidth(), this.getHeight(), null);

        doDrawing(g);
    }

    private void doDrawing(Graphics g) {
        if (inGame) {
            int dots = boardRulesWorkflow.getDots();//zboardRulesStub.query("getDots", int.class);
            int[] x = boardRulesWorkflow.getX();//boardRulesStub.query("getX", int[].class);
            int[] y = boardRulesWorkflow.getY(); //boardRulesStub.query("getY", int[].class);
            g.drawImage(apple, appleX, appleY, this);
            for (int z = 0; z < dots; z++) {
                if (z == 0) {
                    g.drawImage(head, x[z], y[z], this);
                } else {
                    g.drawImage(ball, x[z], y[z], this);
                }
            }

            Toolkit.getDefaultToolkit().sync();

        } else {

            gameOver(g);
        }
    }

    private void gameOver(Graphics g) {
        String msg = gameInfo.get("gameOverMessage").asText();
        Font small = new Font(gameInfo.get("fontName").asText(), Font.BOLD, gameInfo.get("fontSize").asInt());
        FontMetrics metr = getFontMetrics(small);

        g.setColor(Color.white);
        g.setFont(small);
        g.drawString(msg, (gameInfo.get("bWidth").asInt() - metr.stringWidth(msg)) / 2, gameInfo.get("bHeight").asInt() / 2);

        boardRulesWorkflow.exitGame();
        //this.boardRulesStub.signal("exitGame");
    }

    private void locateApple() {

        int r = (int) (Math.random() * gameInfo.get("randPos").asInt());
        appleX = ((r * gameInfo.get("dotSize").asInt()));

        r = (int) (Math.random() * gameInfo.get("randPos").asInt());
        appleY = ((r * gameInfo.get("dotSize").asInt()));
    }

    @Override
    public void actionPerformed(ActionEvent e) {
        if (inGame) {
            checkApple();
            checkCollision();
            move();
        }
        repaint();
    }

    private void move() {
        boardRulesWorkflow.move();
       // boardRulesStub.signal("move");

        if (leftDirection) {
            boardRulesWorkflow.moveLeft();
           // boardRulesStub.signal("moveLeft");
        }

        if (rightDirection) {
            boardRulesWorkflow.moveRight();
            //boardRulesStub.signal("moveRight");
        }

        if (upDirection) {
            boardRulesWorkflow.moveUp();
            //boardRulesStub.signal("moveUp");
        }

        if (downDirection) {
            boardRulesWorkflow.moveDown();
            //boardRulesStub.signal("moveDown");
        }
    }

    private void checkApple() {
        if ((boardRulesWorkflow.getX()[0] == appleX) && (boardRulesWorkflow.getY()[0] == appleY)) {
            boardRulesWorkflow.addDot();
            //boardRulesStub.signal("addDot");
            locateApple();
        }
    }

    private void checkCollision() {
        int dots = boardRulesWorkflow.getDots();//boardRulesStub.query("getDots", int.class);
        int[] x = boardRulesWorkflow.getX();//boardRulesStub.query("getX", int[].class);
        int[] y = boardRulesWorkflow.getY();// boardRulesStub.query("getY", int[].class);

        for (int z = dots; z > 0; z--) {
            if ((z > 4) && (x[0] == x[z]) && (y[0] == y[z])) {
                inGame = false;
            }
        }

        if (y[0] >= gameInfo.get("bHeight").asInt()) {
            inGame = false;
        }

        if (y[0] < 0) {
            inGame = false;
        }

        if (x[0] >= gameInfo.get("bWidth").asInt()) {
            inGame = false;
        }

        if (x[0] < 0) {
            inGame = false;
        }

        if (!inGame) {
            timer.stop();
        }
    }

    private class GameKeyAdapter extends KeyAdapter {

        @Override
        public void keyPressed(KeyEvent e) {

            int key = e.getKeyCode();

            if ((key == KeyEvent.VK_LEFT) && (!rightDirection)) {
                leftDirection = true;
                upDirection = false;
                downDirection = false;
            }

            if ((key == KeyEvent.VK_RIGHT) && (!leftDirection)) {
                rightDirection = true;
                upDirection = false;
                downDirection = false;
            }

            if ((key == KeyEvent.VK_UP) && (!downDirection)) {
                upDirection = true;
                rightDirection = false;
                leftDirection = false;
            }

            if ((key == KeyEvent.VK_DOWN) && (!upDirection)) {
                downDirection = true;
                rightDirection = false;
                leftDirection = false;
            }
        }
    }

}
